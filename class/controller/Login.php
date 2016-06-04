<?php

namespace controller;


use core\Controller;

class Login extends Controller {
    public function __construct() {
        if (isset($_SESSION['id'])) {
            header("location: ".ROOT);
        }
    }
    function index()  {
        $this->model = new \model\Login();
        $data = $this->model->Login();
        $this->view = new \view\Login();
        $this->view->showLogin($data);
    }

}