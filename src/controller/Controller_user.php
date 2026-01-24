<?php


namespace App\Controller;
use Core\Controller;

class LoginController extends Controller {
    public function index() {
        $data = [
            'title' => 'Iniciar Sesión - El Mus-Culito'
        ];  
        
        return $this->render('/user/login', $data);
    }

    public function welcome() {
        $data = [
            'title' => 'Dashboard - El Mus-Culito'
        ];  
        
        return $this->render('/layout/dashboard/welcome', $data);
    }
}