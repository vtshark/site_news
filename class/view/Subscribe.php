<?php
namespace view;


class Subscribe {
    public function mySubs($users)
    {
        $titlePage = "Мои подписки";
        
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
        include "templates/forms/mySubs.php";
        include "templates/footer.php";
    }
}