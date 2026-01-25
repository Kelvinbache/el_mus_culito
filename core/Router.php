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
       $controller = $this-> routers[$method][$url];
              
          if (is_object($controller)) {
             return $controller -> index(); 
          };
      
          if (is_callable($controller)) {
             return $controller();
          }; 
     }
     
     http_response_code(404);
     echo "404 Not Found - El Router no reconoce la ruta: " . $url;
     exit;
    
    //  http_response_code(500);
    //  echo "500 Internal Server Error";
    //  exit;
  }
}