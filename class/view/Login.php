<?php

namespace view;


class Login {
    public function showLogin($data) {
        
        extract($data);
        $user = "";
        $titlePage = "Авторизация";
        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/loginForm.php";
        include "templates/footer.php";
    }
}