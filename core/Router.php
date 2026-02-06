<?php

namespace Core;

class Router {
  protected $routers = [];
 
  public function router($method, $url, $controller){
    $this->routers[$method][$url] = $controller;
  }


  public function run(){
     $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
   
     $prefixes = ['/el_mus_culito/public', '/el_mus_culito'];
     foreach ($prefixes as $prefix) {
         if (strpos($url, $prefix) === 0) {
             $url = substr($url, strlen($prefix));
         }
     }

     $url = rtrim($url, '/') ?: '/';

     $method = $_SERVER["REQUEST_METHOD"] ?? "GET";
               
     if (isset($this->routers[$method])) {
       
        if (isset($this->routers[$method][$url])) {
          
          $controller = $this-> routers[$method][$url];
          
          $data = [
           'username' => $_SESSION['user_session']['username'] ?? 'Invitado',
           'role'     => $_SESSION['user_session']['role'] ?? 'Visitante'
         ];
                   
                   

          if (is_object($controller)) {
            return $controller -> index($url, $data);

          }
          
          if (is_callable($controller)) {
             return $controller();
          }; 
          
       } else {
         http_response_code(404);
         echo "404 Not Found - La ruta no existe: " . $url;
         exit;
       }  
     
      } else {
       http_response_code(405);
       echo "405 Method Not Allowed - El método no está permitido: " . $method;
       exit;
     }
  }
}