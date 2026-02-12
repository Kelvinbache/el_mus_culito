<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../src/controller/Controller_user.php';


$router = new Core\Router();
$login = new App\Controller\LoginController();

// Router is Principal
$router->router("GET", '/',  $login);

// login
$router->router("GET", '/login', $login);
$router->router("POST",'/login', [$login, 'authenticate']);

// sing up
$router->router("GET", '/sing_up', $login);
$router->router("POST",'/sing_up', [$login, 'sing_up']);

// Router is Dashboard
$router->router("GET", '/board', $login);
$router->router("POST",'/board', [$login, 'delete']);

// users 
$router->router("GET", '/client', $login);
$router->router("POST",'/client', $login);

$router->router("GET",  '/user', $login);
$router->router("POST", '/user', $login);

// employee
$router->router("GET", '/employees', $login);
$router->router("POST",'/employees', [$login, 'delete']);

$router->router("GET", '/employees/new_employee', $login);
$router->router("POST",'/employees/new_employee',[$login, 'new_employer']);

$router->router("GET", '/employee', $login);
$router->router("POST",'/employee', $login);

// equipment
$router->router("GET",   '/equipment', $login);
$router->router("POST",  '/equipment', [$login, 'delete']);

$router->router("GET",   '/equipment/new_equipment', $login);
$router->router("POST",  '/equipment/new_equipment', [$login, "new_equipment"]);

// permissions
$router->router("GET", '/permissions', $login);
$router->router("POST",'/permissions', [$login, 'update_permission']);

// edict
$router->router("GET", '/edict', $login);
$router->router("POST",'/edict', [$login, 'edict']);


$router->run();
