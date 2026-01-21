<?php 
require_once 'Database.php';

try {
   
  $db = (new DB_Postgrest())-> connect();
  $sql = "CREATE TABLE ";
  $db.exec($sql);
  echo("The table exit");

} catch (PDOException $error){
    echo $error;
}


?>