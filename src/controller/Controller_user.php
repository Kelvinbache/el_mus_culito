<?php


namespace App\Controller;
use Core\Controller;

class LoginController extends Controller {
    public function index() {     
        return $this->render('/user/login');
    }

    public function welcome() {
        $data = [
            'title' => 'Dashboard - El Mus-Culito'
        ];  
        
        return $this->render('/layout/dashboard/welcome', $data);
    }
}