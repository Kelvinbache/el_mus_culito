<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../src/controller/Controller_user.php';


$router = new Core\Router();
$login = new App\Controller\LoginController();

$router->router("GET", '/home',  $login);
$router->router("GET", '/login', $login);
$router->router("POST",'/login', [$login, 'authenticate']);
$router->router("GET", '/sing_up', $login);
$router->router("POST",'/sing_up', [$login, 'sing_up']);
$router->router("GET", '/dashboard/board', $login);
$router->router("POST",'/dashboard/board', $login);
$router->router("GET", '/dashboard/employees', $login);
$router->router("POST",'/dashboard/employees', $login);
$router->router("GET", '/dashboard/equipment', $login);
$router->router("POST",'/dashboard/equipment', $login);
$router->run();



/**
 * Falta conectar controladores con tabla de rutas
 * Falta manejar sesiones y permisos
 * Falta manejar vistas y plantillas
 * Falta manejar errores y excepciones
*/