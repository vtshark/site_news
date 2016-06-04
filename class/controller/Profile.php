<?php

namespace controller;


use core\Controller;

class Profile extends Controller {
    public function __construct() {
        if (!isset($_SESSION['id'])) {
            header("location: ".ROOT);
        }
    }
    function index() {
        $res = \model\Profile::getProfile();
        $obj = new \view\Profile();
        $obj->editProfile($res);
    }
     function save() {
        $obj = new \model\Profile();
        $error = $obj->updateProfile();
        $res = \model\Profile::getProfile();

        $obj = new \view\Profile();
        $obj->editProfile($res,$error);
    }
    function updateAva() {
        $obj = new \model\Profile();
        $error = $obj->updateAva();

        $res = \model\Profile::getProfile();
        $obj = new \view\Profile();
        $obj->editProfile($res,$error);
    }
    public function userInfo($param) {
        
        $idUser = $param[0];
        $res = \model\Profile::getProfile($idUser);
        $obj = new \view\Profile();
        $obj->showProfile($res);
        
    }

}