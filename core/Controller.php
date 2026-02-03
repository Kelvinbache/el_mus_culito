<?php

namespace Core;

abstract class Controller {
    protected function render($view) {  
        $baseUrl = dirname(__DIR__) . "/views/layout";
        $Path="/../views/layout/";
        
        $viewPath =  $baseUrl . $view . ".php";
      
        if (file_exists($viewPath) && $view === '/dashboard/home') {

            require_once __DIR__ . $Path . "headers/header.php";    

            require_once __DIR__ . $Path . "nav/nav.php";

            include_once $viewPath;

            require_once __DIR__ . $Path . "footers/footer_of_home.php";

        } else if (file_exists($viewPath) && $view === '/user/login') {

            require_once __DIR__ . $Path . "headers/header_of_login.php";    

            include_once $viewPath;
                        

        } else if (file_exists($viewPath) && $view === '/user/sing_up') {

            require_once __DIR__ . $Path . "headers/header_of_sing_up.php";    
            
            include_once $viewPath;    
            
         
        } else if (file_exists($viewPath) && ($view === '/dashboard/board' || $view === '/dashboard/employees' || $view === '/dashboard/equipment') ) {

            require_once __DIR__ . $Path . "headers/header_of_board.php";    
            
            require_once __DIR__ . $Path . "nav/nav_board.php";

            include_once $viewPath;    
            
            require_once __DIR__ . $Path . "footers/footer_of_board.php";

        } else {
          die("Error: La vista '{$view}' no se encuentra en {$viewPath}");
       }  
    }
}