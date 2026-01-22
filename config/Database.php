<?php


require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class DB_Postgrest{
    public $conn;

    public function connect(){
        $this->conn = null;
        try {
           $DB_HOST=$_ENV['DB_HOST'];
           $DB_PORT=$_ENV['DB_PORT'];
           $DB_NAME=$_ENV['DB_NAME'];
           $DB_USER=$_ENV['DB_USER'];
           $DB_PASSWORD=$_ENV['DB_PASSWORD'];
           
           $dns="pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
           $this->conn= new PDO($dns, $DB_USER, $DB_PASSWORD);
           $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $error){
            echo $error;
        }

        return $this->conn;
    }
}

?>