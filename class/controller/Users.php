<?php

namespace controller;


use core\Controller;

class Users extends Controller {
    public function __construct() {
        if (!isset($_SESSION['id'])) {
            header("location: ".ROOT);
        }
    }
    function index() {
        $this->model = new \model\Profile();
        $res = $this->model->getAllUsers();
        $this->view = new \view\Users();
        $this->view->allUsers($res);
    }
}