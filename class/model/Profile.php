<?php

namespace model;


class Profile {
    public static function getProfile($idUser = null) {
        if (!$idUser) {
            $idUser = isset($_SESSION['id']) ? $_SESSION['id']: null;
        }
        if (!$idUser) {
            return null;
        }
        $name = $secondName = $day = $month = $year = "";
        $db = new \core\IDB();
        $what = '';
        $where = ["id_user"=>$idUser];
        $orderColumn = "";
        $desc = "";
        $limit = [0,1];
        $res = $db->select("profile", $what, $where, $orderColumn, $desc, $limit);
        //var_dump($res);
        /*if ($res) {
            $name = $res[0]['name'];
            $secondName = $res[0]['second_name'];

        }*/
        //$out = compact('name','secondName','day','month','year');
        return $res[0];
    }
    public function addProfile($name,$secondName,$idUser) {
        $db = new \core\IDB();
        $id = $db->insert("profile",["name" => $name,
                        "second_name" => $secondName,
                        "id_user" => $idUser]);
        $dir = "static/users/id/$idUser/";
        mkdir($dir);
        $dir = "static/users/id/$idUser/news/";
        mkdir($dir);
        $dir = "static/users/id/$idUser/profile/";
        mkdir($dir);
    }
    public function updateProfile() {
        $error = [];
        $name = $_POST['name'];
        $secondName = $_POST['secondName'];
        $idUser = $_SESSION['id'];
        if ($name!="" && $secondName!="") {
            $db = new \core\IDB();
            $what = ["name" => $name, "second_name" => $secondName];
            $where = ["id_user" => $idUser];
            $res = $db->update("profile", $what, $where);
        } else {
            $error[] = "Не все реквизиты заполнены!";
        }

        return $error;
    }
    public function updateAva() {
        $error = [];
        
        if ( !empty($_FILES) ) {
        
            $idUser = $_SESSION['id'];
            $errImg = \core\Img::addImg($_FILES['userfile'],"profile",$idUser,"");
        
            if ($errImg) {
            
                $error[] = $errImg;
            }
        }
        return $error;
    }
    public static function getName($idUser) {
        $db = new \core\IDB();
        $what = '';
        $where = ["id_user"=>$idUser];
        $orderColumn = "";
        $desc = "";
        $limit = [0,1];
        $res = $db->select("profile", $what, $where, $orderColumn, $desc, $limit);
        //var_dump($res);
        if ($res) {
            $name = $res[0]['name'];
            $secondName = $res[0]['second_name'];
        }
        return $name." ".$secondName;
    }
    public static function getAllUsers() {
        $db = new \core\IDB();
        $what = "";
        $where = "";
        $orderColumn = "";
        $desc = "";
        $limit = "";
        $res = $db->select("profile", $what, $where, $orderColumn, $desc, $limit);
        return $res;
    }
}