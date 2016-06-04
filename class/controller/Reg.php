<?php

namespace controller;


use core\Controller;

class Reg extends Controller {
    public function __construct() {
        if (isset($_SESSION['id'])) {
            header("location: ".ROOT);
        }
    }
    function index()
    {
        $this->model = new \model\Reg();
        $data = $this->model->registration();
        $this->view = new \view\Reg();
        $this->view->showReg($data);
    }

}