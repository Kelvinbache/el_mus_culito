<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../src/controller/Controller_user.php';
require_once __DIR__ . '/../src/controller/donwload.php';



$router = new Core\Router();
$login = new App\Controller\LoginController();
$download = new App\Controller\PDFExportController();

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


$router->router("GET", '/client/new_class', $login);
$router->router("POST",'/client/new_class', [$login, 'Select_Class']);

$router->router("GET",  '/user', $login);
$router->router("POST", '/user', $login);

// employee
$router->router("GET", '/employees', $login);
$router->router("POST",'/employees', [$login, 'delete']);

$router->router("GET", '/employees/new_employee', $login);
$router->router("POST",'/employees/new_employee',[$login, 'new_employer']);

$router->router("GET", '/employee', $login);
$router->router("POST",'/employee', $login);

$router->router("GET", '/employee/new_class', $login);
$router->router("POST",'/employee/new_class', [$login,'new_class']);

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

$router->router("GET",  '/equipment/edict', $login);
$router->router("POST", '/equipment/edict', [$login, 'edict']);

// donwload
$router->router("GET",  '/donwload/client',   [$download, 'pdf_clients']);

$router->router("GET",  '/donwload/employee', [$download, 'pdf_employees']);

$router->router("GET",  '/donwload/equipment',[$download, 'pdf_machines']);



$router->run();



// Falta, 
// Cambiar el idioma
// Poner en los edictores Que puedan cambiar una tabla espedica, como la hora, el dia, 
// errores, un empleado no puede ver la lista de otro
// Falta el boton para sali
// Falta la funcion para borrar o suspenderla
// Falta la funcion para 
// Falta cambiar el conteo de empleados, clientes y maquinas
// lo mismo para los clientes y empleados
// Falta crea el filtro para las busquedas 
// Falta poder poner los permisos de edicion, acceso 