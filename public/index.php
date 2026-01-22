<?php
require_once __DIR__ . '/../config/Tables.php';

try {
     $table = new Tables();    
     $consult = $table -> exists_table();
     echo $consult;

} catch (PDOException $err) {
    echo $err;
}
?>
