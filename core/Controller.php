<?php

namespace Core;

abstract class Controller {
    protected function render($view, $data = []) {  
        extract($data);
            
        $baseUrl = dirname(__DIR__) . "/views/layout";
        $Path="/../views/layout/";
        
        $viewPath =  $baseUrl . $view . ".php";

        if (!file_exists($viewPath)){
            die("Error: La vista '{$view}' no se encuentra en {$viewPath}");
        }

        switch($view){
            
            case '/dashboard/home':  
            include $viewPath;
            break;
            
            case '/user/login':
            include $viewPath;
            break;
            
            case '/user/sing_up':    
            include $viewPath;
            break;
            
            case '/dashboard/board':       
            include $viewPath;
            break; 

            case '/dashboard/permissions':
            include $viewPath;
            break;

            case '/client/client':
            include $viewPath;
            break;
            
            case '/employee/employee':
            include $viewPath;
            break;
            
            case(str_starts_with($view,"/dashboard")):
            require_once __DIR__ . $Path . "headers/header_of_board.php";
            require_once __DIR__ . $Path . "headers/permissions_header.php";
            require_once __DIR__ . $Path . "nav/nav_board.php"; 
            include $viewPath;
            require_once __DIR__ . $Path . "footers/footer_of_board.php"; 
        }        
    }
}