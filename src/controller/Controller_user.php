<?php

namespace App\Controller;

require_once __DIR__ . '/../../config/Tables.php';

use Core\Controller;

class LoginController extends Controller {
    public function index($url) {     
        return $this->render($url);
    }


    public function authenticate() {
       $db = new \Config\Tables();
       $user = $_POST['username'];
       $pass = $_POST['password'];
      

       if (empty($user) || empty($pass)) {
           return $this->render('/login', ['error' => 'Username and password are required.']);
      
           } else {
            $table_status = $db->exists_table();
            $stmt = $table_status->prepare("SELECT * FROM people WHERE user_name = :user_name AND user_password = :user_password");
            $stmt->bindParam(':user_name', $user);
            $stmt->bindParam(':user_password', $pass);
            $stmt->execute();
            $result = $stmt->fetch();
            
            if ($result) {
                return $this->render('/dashboard/board');
          
            } else {
                return $this->render('/user/login', ['error' => 'Invalid credentials.']);
          }
       }      
    }

    
    public function sing_up() {
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
             $stmt = $table_status->prepare("INSERT INTO people (user_name, user_lastname, user_dni, user_phone, user_email, user_password) VALUES (:user_name, :user_lastname, :user_dni, :user_phone, :user_email, :user_password)");
             $stmt->bindParam(':user_name', $name);
             $stmt->bindParam(':user_lastname', $lastname);
             $stmt->bindParam(':user_dni', $dni);
             $stmt->bindParam(':user_phone', $Phone);
             $stmt->bindParam(':user_email', $email);
             $stmt->bindParam(':user_password', $pass);
             $stmt->execute();
             
             return $this->render('/dashboard/board', ['success' => 'Account created successfully. Please log in.']);
        } 
     }

}