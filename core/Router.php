<?php

namespace Core;

class Router {
  protected $routers = [];

  public function get($url, $controller){
     $this-> routers["GET"][$url] = $controller;
  }

  public function run(){
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
    $uri = str_replace('/el_mus_culito/public', '', $uri);
    $uri = $uri === '' ? '/' : $uri;
    
    // $callback =$this-> routers[$method][$uri]; 
  }
}