<?php

namespace view;


class Reg {
    public function showReg($data) {

        extract($data);
        $titlePage = "Регистрация";
        $user = "";
        $city = "";
        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/regForm.php";
        include "templates/footer.php";
    }
}