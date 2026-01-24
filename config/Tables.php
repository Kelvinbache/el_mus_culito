<?php 
require_once 'Database.php';


class Tables {
   public $db; 
   
   public function __construct() {
       $database = new DB_Postgrest();
       $this->db = $database-> connect();
   }
   
   public function exists_table(){
    try {
       $sql = " 
       SELECT EXISTS ( 
       SELECT 1 
       FROM information_schema.tables 
       WHERE table_schema = 'public' AND table_name IN 
       ('people', 'user', 'machines', 'class', 'class_schedule ', 'plan', 'membership', 'payments' , 'attendance'));";
  
       $smt = $this->db->query($sql);
       $consult = (bool) $smt->fetchColumn();
       
       if ($consult) {
         return "the tables already exist";

       } else {
         return $this->create_tables();
       }
  
    } catch (PDOException $err){
       echo $err;
    } 
  }

  public function create_tables(){
    try {
       $sql = "
       create type user_type as enum('user', 'employee', 'admin');
       
       create type machine_status as enum('operational', 'not operational');
       
       create type days as enum(
         'Monday',
         'Tuesday',
         'Wednesday',
         'Thursday',
         'Friday',
         'Saturday',
         'Sunday'
       );
       
       create type membership_status as enum('pending', 'paid', 'expired');
       
       create type payment_method as enum(
         'pago movil',
         'foreign exchange',
         'point of sale',
         'transfer'
       );
       
       create table IF NOT EXISTS people (
         id_people serial primary key,
         user_name varchar(255) not null,
         user_lastname varchar(255) not null,
         user_dni varchar(12) unique not null,
         user_email varchar(255) unique not null
       );
       
       create table IF NOT EXISTS \"user\" (
         id_user serial primary key,
         id_people int references people (id_people),
         type_user user_type default 'user' not null
       );
       
       create table IF NOT EXISTS machines (
         id_machine serial primary key,
         id_employee int references \"user\" (id_user),
         machine_name varchar(255) unique not null,
         machine_status machine_status not null,
         count_machine int default 0 not null
       );
       
       create table IF NOT EXISTS class (
         id_class serial primary key,
         employee int references \"user\" (id_user),
         class_name varchar(255) unique not null
       );
       
       create table IF NOT EXISTS class_schedule (
         id_class_schedule serial primary key,
         id_class int references class (id_class),
         days days not null,
         hours time not null
       );
       
       create table IF NOT EXISTS plan (
         id_plan serial primary key,
         name_plan varchar(255) not null,
         price numeric(10, 2) default 0.00 not null
       );
       
       create table IF NOT EXISTS membership (
         id_membership serial primary key,
         id_plan int references plan (id_plan),
         id_user int references \"user\" (id_user),
         description text not null,
         membership_status membership_status not null,
         price_at_purchase numeric(10, 2) not null,
         start_date date default current_date not null,
         end_date date default current_date not null
       );
       
       create table IF NOT EXISTS payments (
         id_payments serial primary key,
         id_membership int references membership (id_membership),
         payment_method payment_method not null,
         reference_number varchar(30) unique not null,
         amount numeric(10, 2) default 0.00 not null,
         payment_date date default current_date not null
       );
       
       create table IF NOT EXISTS attendance (
         id_attendance serial primary key,
         id_user int references \"user\" (id_user),
         check_in_time timestamp default current_timestamp not null
       );";

       $this->db->exec($sql);
       return "exict in create tables";
  
    } catch (PDOException $err){
       echo $err;
    } 
  }
}
?>