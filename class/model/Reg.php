<?php

namespace model;


class Reg {

    public function registration() {
        $out = [];
        $error = [];
        $msg = "";

        $login = isset($_POST['login']) ? $_POST['login'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $pass = isset($_POST['password']) ? $_POST['password'] : "";
        $pass1 = isset($_POST['password1']) ? $_POST['password1'] : "";
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $secondName = isset($_POST['secondName']) ? $_POST['secondName'] : "";
        
        if (!empty($_POST)) {
            
            if ($login == "") {
                $error[] = "Введите login!";
            }
            if (($email == "") || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $error[] = "Некорректный e-mail!";
            }
            if ($name == "") {
                $error[] = "Введите имя пользователя!";
            }
            if ($secondName == "") {
                $error[] = "Введите фамилию пользователя!";
            }
            if (($pass == "") || ($pass1 == "")) {
                $error[]="Введите и подтвердите пароль!";
            } else {
                if ($pass != $pass1) {
                    $error[]="Введенный и подтвержденный пароли не совпадают!";
                }
            }
        }
        if  ( (!$error) && (!empty($_POST)) ) {
            $user = new \model\User();
            $res = $user->getUserExist($login);
            if ($res) {
                $error[] = "Пользователь с таким логином уже существует!";
            } else {
                $idUser = $user->addUser($login,$email,$pass);

                $profile = new \model\Profile();
                $profile->addProfile($name,$secondName,$idUser);

                //$msg = "Регистрация завершена!";
                $_SESSION['id'] = $idUser;
                header("Location: ".ROOT);
            }

        }

        $data = compact('out','error','login','email','name','secondName','msg');
        return $data;
    }
}