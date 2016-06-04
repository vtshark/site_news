<?php

namespace view;


class Profile {
    public function editProfile($v,$error = null) {

        if (isset($_SESSION['id'])) {
            //$arr = \model\Profile::getProfile();
            $user = $v['name'] . " " . $v['second_name'];
            $idUser = $_SESSION['id'];
            $titlePage = $user;
        } else {
            $user = "";
        }
        $day = $month = $year = "";
        //var_dump($v);
        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/profileEdit.php";
        include "templates/footer.php";
    }
    public function showProfile($v) {
        if (isset($_SESSION['id'])) {
            $arr = \model\Profile::getProfile();
            $user = $arr['name'] . " " . $arr['second_name'];
            $idUser = $_SESSION['id'];
            $titlePage = $v['name'] . " " . $v['second_name'];;
        } else {
            $user = "";
        }
        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/profileForm.php";
        include "templates/footer.php";
    }

}