<?php

namespace App\Controller;

require_once __DIR__ . '/../../config/Tables.php';

use PDO;

class All_list {
    public function all_list_user(){
            try {
             $db = new \Config\Tables();
             $table_status = $db->exists_table();
             $stmt = $table_status->prepare("SELECT u.id_user, p.id_people, p.user_name, p.user_email, p.user_dni, p.user_lastname, p.user_phone, u.type_user FROM people p LEFT JOIN \"user\" u ON p.id_people = u.id_people WHERE u.type_user IS NOT NULL"); 
             $stmt->execute();
             $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
             return $result;
        
             } catch (\PDOException $e) {
              error_log("Error en all_list_user: " . $e->getMessage());
              return [];
        }

    }

    public function all_list_machines(){
        try{
            $db = new \Config\Tables();
            $conn = $db->exists_table();
            $sql= ("SELECT id_machine, machine_name, machine_status, count_machine FROM machines;");
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        
        catch(\PDOException $e){
            error_log("Error en all_list_machines: " . $e->getMessage());
            return [];
        }
    }
    

    public function all_list_class(){
        try{
 
            $db = new \Config\Tables();
            $conn = $db->exists_table();
            $sql = ("
                SELECT
                cs.id_class_schedule, 
                c.id_class,
                c.class_name,
                p.user_name,
                p.user_lastname,
                cs.days::text AS days, 
                TO_CHAR(cs.hours, 'HH12:MI AM') AS hours 
            FROM class c
            JOIN \"user\" u ON c.employee = u.id_user
            JOIN people p ON u.id_people = p.id_people
            JOIN class_schedule cs ON c.id_class = cs.id_class
            GROUP BY cs.id_class_schedule, c.id_class, c.class_name, p.user_name, p.user_lastname
            ORDER BY cs.hours;
        ");
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        
        catch(\PDOException $e){
            error_log("Error en all_list_machines: " . $e->getMessage());
            return [];
        }
    }

   public function all_list_client(){
     try {
      
     $db = new \Config\Tables();
     $conn = $db->exists_table();   
    
    $sql = ("SELECT
            u_cli.id_people,  
            a.id_attendance,
            p_cli.user_name,
            p_cli.user_lastname,
            p_cli.user_email,
            c.class_name,
            cs.days,
            TO_CHAR(a.check_in_time, 'HH12:MI AM') AS hours
        FROM attendance a
        JOIN \"user\" u_cli ON a.id_user = u_cli.id_user
        JOIN people p_cli ON u_cli.id_people = p_cli.id_people
        JOIN class_schedule cs ON a.id_class = cs.id_class_schedule
        JOIN class c ON cs.id_class = c.id_class
        ORDER BY a.check_in_time DESC;
    ");

     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
     return $result;

     }
     
     catch(\PDOException $err){
          error_log("Error en all_list_machines: " . $err->getMessage());
          return [];
     }
   }
   
   public function list_class_client($data){
      extract($data);

    try {
      
     $db = new \Config\Tables();
     $conn = $db->exists_table();   
    
    $sql = ("SELECT 
            c.class_name,
            p.user_name,
            p.user_email,
            cs.days::text,
            TO_CHAR(cs.hours, 'HH12:MI AM') AS hours,
            TO_CHAR(a.check_in_time, 'DD/MM/YYYY') 
        FROM attendance a
        JOIN class_schedule cs ON a.id_class = cs.id_class_schedule
        JOIN class c ON cs.id_class = c.id_class
        JOIN \"user\" u ON c.employee = u.id_user
        JOIN people p ON u.id_people = p.id_people
        WHERE a.id_user = :id_user;
    ");

     $stmt = $conn->prepare($sql);
     $stmt->execute([
        ':id_user' => $id
     ]
     );
     $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
     return $result;

     }
     
     catch(\PDOException $err){
          error_log("Error en all_list_machines: " . $err->getMessage());
          return [];
     }
   }
}