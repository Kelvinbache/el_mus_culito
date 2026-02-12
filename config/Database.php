<?php

namespace Config;

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/../.env')) {
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();   
}



class DB_Postgrest{
    public $conn;

    public function connect(){
        $this->conn = null;
        try {

        //    $url = getenv('DATABASE_URL') ?: ($_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? null);

        //    if (!$url) {
        //      throw new \Exception("La variable DATABASE_URL no está configurada. Fuentes revisadas: getenv, ENV, SERVER.");
        //    }
                      
        //    $dbConfig = parse_url($url);
        //    $host = $dbConfig['host'] ?? null;
        //    $port = $dbConfig['port'] ?? '5432';
        //    $user = $dbConfig['user'] ?? null;
        //    $pass = $dbConfig['pass'] ?? null;
        //    $dbname = ltrim(explode("?",$dbConfig['path'] ?? '')[0], '/');

           $DB_HOST=$_ENV['DB_HOST'];
           $DB_PORT=$_ENV['DB_PORT'];
           $DB_NAME=$_ENV['DB_NAME'];
           $DB_USER=$_ENV['DB_USER'];
           $DB_PASSWORD=$_ENV['DB_PASSWORD'];

        //    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        
        //    $this-> conn = new \PDO($dsn, $user, $pass, [
        //     \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        //     \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
           
        //     ]);
           
           $dns="pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
           $this->conn= new \PDO($dns, $DB_USER, $DB_PASSWORD);
           $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $error){
            echo $error;
        }

        return $this->conn;
    }
}

?>