<?php

namespace model;


class Login {

    public function login() {
        $error = [];
        $login = $pass = "";
        
        if (!empty($_POST)) {
            $login = $_POST['login'];
            $pass = $_POST['password'];
            /*$filter = 'login';
            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
               $filter = 'email';
            }*/
            $pass = md5($pass);
            $user = new \model\User();
            $idUser = $user->checkPass($login,$pass);
            if ($idUser) {
            } else {
                $error[] = "Не верные имя пользователя или пароль!";
            }
        }
        if (!$error && $login != '' && $pass != '') {
            \model\User::login($idUser);
            header("Location: ".ROOT);
        }
        $data = compact('error','login');
        return $data;
    }

}