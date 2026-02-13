<?php

namespace App\Controller;

require_once __DIR__ . '/../../config/Tables.php';
require_once __DIR__ . "./../controller/Controller_All_list.php";

use Core\Controller;
use PDO;
use App\Controller\All_list;
use LDAP\Result;

class LoginController extends Controller {
    public function index($url, $data = []) {  

        $PATH = null;
        $all_list = new  All_list();
        $data["user"] = $all_list->all_list_user();
        $data["machine"] = $all_list->all_list_machines();
        $data["class"] = $all_list->all_list_class();

        switch($url) {
            
          case($url === "/"):
          $PATH = "/dashboard/home";
          return $this->render($PATH, $data);
          break;

          case($url === "/login" || $url ==="/sing_up"):
          $PATH = "/user";
          break;
          
          case($url === "/client"):
             $PATH = "/client";
             break;

          case($url === "/client/new_class"):
            break;  

          case($url === "/employee"):
             $PATH = "/employee";
             break;
          
           case($url === "/employee/new_class"):   
            break;
            
          case($url === "/edict"):
             $PATH = "/edict";
             break; 

          case($url === "/employees/new_employee"):
            break;

          case($url === "/equipment/new_equipment"):
            break;

          case($url === "/equipment/edict"):
          break;
        
       
          case($url === "/board" || $url === "/user" || $url === "/employees" || $url === "/equipment" || $url === "/permissions"):
            $PATH = "/dashboard";
            break;  
        } 
         
        return $this->render($PATH . $url, $data);
    }


    public function authenticate() {
       try{   
    
       $db = new \Config\Tables();
       $user = $_POST['username'];
       $pass = $_POST['password'];
      

       if (empty($user) || empty($pass)) {
           return $this->render('/login', ['error' => 'Username and password are required.']);
      
        } else {
            $table_status = $db->exists_table();
            $stmt = $table_status->prepare("SELECT id_people  FROM people WHERE user_name = :user_name AND user_password = :user_password");
            $stmt->bindParam(':user_name', $user);
            $stmt->bindParam(':user_password', $pass);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            

            $stmt = $table_status->prepare("SELECT id_user, type_user FROM \"user\" WHERE id_people = :id_people");
            $stmt->bindParam(':id_people', $result["id_people"]);
            $stmt->execute();
            $new_user = $stmt->fetch(\PDO::FETCH_ASSOC);

            $_SESSION['user_session'] = [
            'id'        => $new_user["id_user"],
            'username'  => $user,
            'role'      => $new_user["type_user"]
            ];
          
            session_write_close();
            
            switch($new_user["type_user"]) {
                    case "user": 
                        header("Location: /el_mus_culito/client");     
                        break;

                    case "employee":
                        header("Location: /el_mus_culito/employee");
                        break;
                    
                    case "admin": 
                        header("Location: /el_mus_culito/board"); 
                        break;

                    default:
                       echo ("client not found");   
            }
        }

       } catch (\PDOException $err) {
          echo $err;
    }
}      

    
    public function sing_up() {
        try {

        $db = new \Config\Tables();
        $name = $_POST['username'];
        $lastname = $_POST['lastname'];
        $dni = $_POST['Cedula'];
        $Phone = $_POST['Phone'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
       
        if (empty($name) || empty($lastname) || empty($dni) || empty($Phone) || empty($email) || empty($pass)) {
            return $this->render('/user/sing_up', ['error' => 'All fields are required.']);
       
            } else {
             

             $table_status = $db->exists_table();
             $stmt = $table_status->prepare("INSERT INTO people (user_name, user_lastname, user_dni, user_phone, user_email, user_password) VALUES (:user_name, :user_lastname, :user_dni, :user_phone, :user_email, :user_password) RETURNING id_people");
             $stmt->bindParam(':user_name', $name);
             $stmt->bindParam(':user_lastname', $lastname);
             $stmt->bindParam(':user_dni', $dni);
             $stmt->bindParam(':user_phone', $Phone);
             $stmt->bindParam(':user_email', $email);
             $stmt->bindParam(':user_password', $pass);
             $stmt->execute();
             
             $new_person = $stmt->fetch(\PDO::FETCH_ASSOC);
             $id_new_person = $new_person['id_people'];


             $stmt = $table_status->prepare("INSERT INTO \"user\" (id_people) values(:id_people)");
             $stmt->bindParam(':id_people', $id_new_person);  
             $stmt->execute();
             
             header("Location: /el_mus_culito/user");    
             
        } 
      
       } catch (\PDOException $err){
               echo $err;
    };
        
  }

public function new_employer () {
        try {

        $db = new \Config\Tables();
        $name = $_POST['username'];
        $lastname = $_POST['lastname'];
        $dni = $_POST['Cedula'];
        $Phone = $_POST['Phone'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
       
        if (empty($name) || empty($lastname) || empty($dni) || empty($Phone) || empty($email) || empty($pass)) {
            return $this->render('/user/sing_up', ['error' => 'All fields are required.']);
       
            } else {
             

             $table_status = $db->exists_table();
             $stmt = $table_status->prepare("INSERT INTO people (user_name, user_lastname, user_dni, user_phone, user_email, user_password) VALUES (:user_name, :user_lastname, :user_dni, :user_phone, :user_email, :user_password) RETURNING id_people");
             $stmt->bindParam(':user_name', $name);
             $stmt->bindParam(':user_lastname', $lastname);
             $stmt->bindParam(':user_dni', $dni);
             $stmt->bindParam(':user_phone', $Phone);
             $stmt->bindParam(':user_email', $email);
             $stmt->bindParam(':user_password', $pass);
             $stmt->execute();
             
             $new_person = $stmt->fetch(\PDO::FETCH_ASSOC);
             $id_new_person = $new_person['id_people'];


             $stmt = $table_status->prepare("INSERT INTO \"user\" (id_people, type_user) values(:id_people, :type_user)");
             $stmt->bindValue(':id_people', $id_new_person);
             $stmt->bindValue(':type_user', "employee");
             $stmt->execute();
             header("Location: /el_mus_culito/employees");
             exit();    
             
        } 
      
       } catch (\PDOException $err){
               echo $err;
    };
        
  }
  
  public function update_permission(){
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role'])) {

        try {

            $db = new \Config\Tables();
            $conn = $db->exists_table();

            $sql = "UPDATE \"user\" SET type_user = :role WHERE id_people = :id";
            $stmt = $conn->prepare($sql);

            foreach ($_POST['role'] as $id_people => $new_role) {
                $stmt->execute([
                    ':role' => $new_role,
                    ':id'   => $id_people
                ]);
            }

            $_SESSION['message'] = "Permissions updated correctly!";

        } catch (\PDOException $e) {
            error_log("Error updating roles: " . $e->getMessage());
        }
    }

    header("Location: /el_mus_culito/permissions");
    exit;
  }

 public function new_equipment(){
    try {
      
      $id_admin = $_POST["admin_id"] ?? null;
      $machine_name = $_POST["machine_name"] ?? null;
      $count_machine = $_POST["count_machine"] ?? null;
      $status = $_POST["status"] ?? null;
      
      if (empty($id_admin)){
          header('Content-Type: application/json');     
          echo json_encode(['error' => 'Log in before']);
          exit();
      
        } else {
    
        if (empty($machine_name) || empty($count_machine) || empty($status)){
          header('Content-Type: application/json');     
          echo json_encode(['error' => 'All fields are required']);
          exit();  
        
        } else {
          
          $db = new \Config\Tables();
          $conn = $db->exists_table();
          
          $sql = ("
          
          INSERT INTO machines 
          (id_employee, machine_name, count_machine, machine_status) 
          VALUES (:id_admin, :machine_name, :count_machine, :status)");
          
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':id_admin', $id_admin);
          $stmt->bindParam(':machine_name', $machine_name);
          $stmt->bindParam(':count_machine', $count_machine);
          $stmt->bindParam(':status', $status);
          $stmt->execute();
          
          header("Location: /el_mus_culito/equipment");
          exit();
        }
    }
      
    } catch (\PDOException $err){
        echo $err->getMessage();
    }
 }

  public function new_class(){
     try{
        
        $db = new \Config\Tables();
        $conn = $db->exists_table();

        $id_employee = $_POST["id_employee"] ?? null;
        $class_name = $_POST["class_name"] ?? null;
        $days = $_POST["days"] ?? [];
        $hours = $_POST["hours"] ?? null;
        
        if (empty($id_employee) || empty($class_name) || empty($hours)){
          header('Content-Type: application/json');     
          echo json_encode(['error' => 'All fields are required']);
          exit();  
        
        } else {
           
           $conn->beginTransaction();

           $sql = "INSERT INTO class (employee, class_name) VALUES (:id_employee, :class_name) RETURNING id_class";
           $stmt = $conn->prepare($sql);
           $stmt->execute([
            ':id_employee'  => $id_employee,
            ':class_name' => $class_name
           ]);
           

           $new_class = $stmt->fetch(\PDO::FETCH_ASSOC);
           $id_class = $new_class['id_class'];

           $sqlSchedule = "INSERT INTO class_schedule (id_class, days, hours) VALUES (:id, :day, :hour)";
           $stmt2 = $conn->prepare($sqlSchedule);

           foreach ($days as $day) {
            $stmt2->execute([
                ':id'   => $id_class,
                ':day'  => $day,   
                ':hour' => $hours   
            ]);

            $conn->commit();

            header("Location: /el_mus_culito/employee");
            exit();
        }
    }
       
      
     } catch (\PDOException $e){
         error_log("Error updating roles: " . $e->getMessage());
     }
  }



  public function delete() {
    try {
    
    $id = $_POST['id'] ?? null;
    $role = $_POST['role'] ?? null;
    $from = $_SERVER['HTTP_REFERER'] ?? '';
    

   if (isset($id) && intval($id)){   
       
       $db = new \Config\Tables();
       $conn = $db->exists_table();
       
       if (strpos($from, 'equipment') === false) {

          $stmtUser = $conn->prepare("DELETE FROM \"user\" WHERE id_people = :id");
          $stmtUser->bindValue(':id', $id, \PDO::PARAM_INT);
          $stmtUser->execute();
 
          $stmt = $conn->prepare("DELETE FROM people WHERE id_people = :id");           
          $stmt->bindValue(':id', $id, \PDO::PARAM_INT); 
          $stmt->execute();
       
        } else {
       
          $stmtUser = $conn->prepare("DELETE FROM machines WHERE id_machine= :id");
          $stmtUser->bindValue(':id', $id, \PDO::PARAM_INT);
          $stmtUser->execute();
        
        }
       
        switch($role){
            case 'user':
                header("Location: /el_mus_culito/board");
                break;   
        
            case 'employee':
                header("Location: /el_mus_culito/employees");
                break;
            
            case 'admin':    
                header("Location: /el_mus_culito/equipment");
                break;      
        }

        exit();
            
    } else {
        header("Location: /board");
        exit();
     }
        
    
    } catch (\PDOException $err){
        error_log($err->getMessage());
        header("Location: /el_mus_culito/board?error=db");
        exit();
}
  
}


public function edict(){
   try {
        
        $db = new \Config\Tables();
        $table_status = $db->exists_table();
        $from = $_SERVER['HTTP_REFERER'] ?? '';
        $role     = $_POST['role'] ?? null;
        
        if (strpos($from, 'equipment') === false) {
            
        $id       = $_POST['id'] ?? null;
        $name     = $_POST['username'] ?? null;
        $lastname = $_POST['lastname'] ?? null;
        $dni      = $_POST['dni'] ?? null;
        $email    = $_POST['email'] ?? null;
        $pass     = $_POST['password'] ?? null;
        $phone     = $_POST['phone'] ?? null;
        
        if (empty($name) || empty($lastname) || empty($dni) || empty($phone) || empty($email) || empty($id)) {
            
            header('Content-Type: application/json');     
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            exit();    
        
        } else {
           
             $stmt = $table_status->prepare("
             UPDATE people SET 
             user_name = :user_name,  
             user_lastname = :user_lastname, 
             user_dni = :user_dni, 
             user_phone = :user_phone, 
             user_email = :user_email, 
             user_password = :user_password   
             WHERE id_people = :id");
    
             $stmt->execute([
                ':user_name'     => $name,
                ':user_lastname' => $lastname,
                ':user_dni'      => $dni,
                ':user_phone'    => $phone,
                ':user_email'    => $email,
                ':user_password' => $pass,
                ':id'            => $id
             ]);    
         }

        } else {
          
          $id_machine  =  $_POST["id_machine"] ?? null;    
          $machine_name = $_POST["machine_name"] ?? null;
          $count_machine = $_POST["count_machine"] ?? null;
          $status = $_POST["status"] ?? null;
          
           if (empty($status) || empty($machine_name) || empty($count_machine) || empty($id_machine)) { 
                header('Content-Type: application/json');     
                echo json_encode(['error' => 'Todos los campos son obligatorios.']);
                exit();    

           } else {
                $stmt = $table_status->prepare("
                 UPDATE machines SET 
                 machine_name = :machine_name, 
                 count_machine = :count_machine, 
                 machine_status = :status
                 WHERE id_machine = :id_machine");
    
                $stmt->execute([
                   ':machine_name'  => $machine_name,
                   ':count_machine' => $count_machine,
                   ':status'        => $status,
                   ':id_machine'      => $id_machine
                ]);
           }
        }
        
        switch($role){
           case 'user':
               header("Location: /el_mus_culito/board");
               break;   
       
           case 'employee':
               header("Location: /el_mus_culito/employees");
               break;
           
           case 'admin':    
               header("Location: /el_mus_culito/equipment");
               break;      
      }

           exit();  
        } catch (\PDOException $err){
               echo "Error: " . $err->getMessage();
    }
  }
  

  public function edict_class(){
    try{

      


    }catch(\PDOException $err){
        echo "Error: " . $err->getMessage();
    }
  }
}