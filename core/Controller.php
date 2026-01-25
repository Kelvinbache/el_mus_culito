<?php

namespace Core;

abstract class Controller {
    protected function render($view) {
    
        $baseUrl = dirname(__DIR__) . "/src/views/layout";
        
        $viewPath = $baseUrl . $view . ".php";
      
        if (file_exists($viewPath)) {
            
        if(file_exists($baseUrl . "header.php")) include $baseUrl . "header.php";
            
            include $viewPath;

        if(file_exists($baseUrl . "footer.php")) include $baseUrl . "footer.php";

            } else {
            die("Error: La vista '{$view}' no se encuentra en {$viewPath}");
        }
    }
}