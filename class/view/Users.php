<?php

namespace view;


class Users {
    public function allUsers($users)
    {
        $titlePage = "Пользователи";
        //var_dump($users);
        if (isset($_SESSION['id'])) {
            $arr = \model\Profile::getProfile();
            $user = $arr['name'] . " " . $arr['second_name'];
            $idUser = $_SESSION['id'];
        } else {
            $user = "";
            $idUser = "";
        }
        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/users.php";
        include "templates/footer.php";
    }
}