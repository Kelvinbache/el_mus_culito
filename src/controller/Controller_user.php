<?php

namespace App\Controller;

require_once __DIR__ . '/../../config/Tables.php';
require_once __DIR__ . "./../controller/Controller_All_list.php";

use Core\Controller;
use PDO;
use App\Controller\All_list;


class LoginController extends Controller {
    public function index($url, $data = []) {  

        $PATH = null;
        $all_list = new  All_list();
        $data["user"] = $all_list->all_list_user();

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
          case($url === "/employee"):
             $PATH = "/employee";
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
            

            $stmt = $table_status->prepare("SELECT type_user FROM \"user\" WHERE id_people = :id_people");
            $stmt->bindParam(':id_people', $result["id_people"]);
            $stmt->execute();
            $type_user = $stmt->fetch(\PDO::FETCH_ASSOC);

            $_SESSION['user_session'] = [
            'username'  => $user,
            'role'      => $type_user["type_user"]
            ];
          
            session_write_close();
            
            switch($type_user["type_user"]) {
                    case "user": 
                        header("Location: /client");     
                        break;

                    case "employee":
                        header("Location: /employee");
                        break;
                    
                    case "admin": 
                        header("Location: /board"); 
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
}