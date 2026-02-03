<?php

namespace Core;

class Router {
  protected $routers = [];
 
  public function router($method, $url, $controller){
    $this->routers[$method][$url] = $controller;
  }


  public function run(){
     $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
     $url = str_replace('/el_mus_culito/public', '', $url);
     $url = str_replace('/el_mus_culito', '', $url);
     $url = ($url === '' || $url === '/') ? '/' : $url;
    
     $method = $_SERVER["REQUEST_METHOD"] ?? "GET";
     
     if (isset($this->routers[$method])) {
       
        if (isset($this->routers[$method][$url])) {
            $controller = $this-> routers[$method][$url];
           
            if (is_object($controller)) {
              
            if ($url === '/home') {
               return $controller -> index("/dashboard" . $url);
              }    
              
            if ($url === '/login') {
                return $controller -> index("/user" . $url); 
            }

            if ($url === '/sing_up') {
                return $controller -> index("/user" . $url);  
            }

            if ($url === '/dashboard/board') {
                return $controller -> index($url);
              
            }

            if ($url === '/dashboard/employees'){
                return $controller -> index($url);
            }

            if ($url === "/dashboard/equipment"){
               return $controller -> index($url);
            }
          
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
    //  http_response_code(500);
    //  echo "500 Internal Server Error";
    //  exit;
  }
}