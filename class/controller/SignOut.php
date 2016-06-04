<?php

namespace controller;


use core\Controller;

class SignOut extends Controller {
    public function index() {
        \model\User::logout();
        header("Location: ".ROOT);
    }

}