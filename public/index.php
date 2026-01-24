<?php
// require_once __DIR__ . '/../config/Tables.php';

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../src/controller/Controller_user.php';

$router = new Core\Router();
$loginCtrl = new App\Controller\LoginController();

$router->router("GET", '/', $loginCtrl);
$router->router("GET", '/login', $loginCtrl);
$router->router("POST", '/login', $loginCtrl);
$router->run();

// try {
//      $table = new Tables();    
//      $consult = $table -> exists_table();
//      echo $consult;

// } catch (PDOException $err) {
//     echo $err;
// }
?>
