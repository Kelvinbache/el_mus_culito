<?php

namespace App\Controller;

require_once __DIR__ . '/../../config/Tables.php';

use PDO;

class All_list {
    public function all_list_user(){
            try {
             $db = new \Config\Tables();
             $table_status = $db->exists_table();
             $stmt = $table_status->prepare("SELECT p.id_people, p.user_name, p.user_email, u.type_user FROM people p LEFT JOIN \"user\" u ON p.id_people = u.id_people WHERE u.type_user IS NOT NULL"); 
             $stmt->execute();
             $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
             return $result;
        
             } catch (\PDOException $e) {
              error_log("Error en all_list_user: " . $e->getMessage());
              return [];
        }
    }
}