<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../src/controller/Controller_user.php';


$router = new Core\Router();
$login = new App\Controller\LoginController();

// Router is Principal
$router->router("GET", '/home',  $login);

$router->router("GET", '/login', $login);
$router->router("POST",'/login', [$login, 'authenticate']);

$router->router("GET", '/sing_up', $login);
$router->router("POST",'/sing_up', [$login, 'sing_up']);

// Router is Dashboard
$router->router("GET", '/board', $login);
$router->router("POST",'/board', $login);

$router->router("GET", '/client', $login);
$router->router("POST",'/client', $login);

$router->router("GET", '/employee', $login);
$router->router("POST",'/employee', $login);

$router->router("GET", '/user', $login);
$router->router("POST",'/user', $login);

$router->router("GET", '/employees', $login);
$router->router("POST",'/employees', $login);

$router->router("GET", '/equipment', $login);
$router->router("POST",'/equipment', $login);

$router->router("GET", '/permissions', $login);
$router->router("POST",'/permissions', [$login, 'update_permission']);
$router->run();



/**
 * Falta conectar controladores con tabla de rutas
 * Falta manejar sesiones y permisos
 * Falta manejar vistas y plantillas
 * Falta manejar errores y excepciones
*/