<?php

namespace model;


class User {
    public function addUser($login,$email,$pass) {
        $obj = new \core\IDB();
        $id = $obj->insert("users",["login" => $login,"email" => $email,"passwd" => md5($pass)]);
        return $id;
    }
    public function getUserExist($login = "") {
        $db = new \core\IDB();
        $what = '';
        $where = ["login"=>$login];
        $orderColumn = "";
        $desc = "";
        $limit = [0,1];
        $res = $db->select("users", $what, $where, $orderColumn, $desc, $limit);
        if (!$res) {
            return false;
        } else {
            return true;
        }
    }
    public function checkPass($login = "",$pass = "") {
        $db = new \core\IDB();
        $what = '';
        $where = ["login"=>$login,"passwd"=>$pass];
        $orderColumn = "";
        $desc = "";
        $limit = [0,1];
        $res = $db->select("users", $what, $where, $orderColumn, $desc, $limit);
        if (!$res) {
            return false;
        } else {
            return $res[0]['id'];
        }
    }
    public static function login($idUser) {
        $token = md5( "the".$idUser."prodigy" );
        $_SESSION['id'] = $idUser;
        setcookie("id",$idUser,null,"/");
        setcookie("token",$token,null,"/");
    }
    public static function logout() {
        setcookie("id","",time() - 3600,"/");
        $_SESSION['id'] = "";
        session_destroy();
    }
    public static function getTrueUser() {
        if (isset($_COOKIE['id']) && (isset($_COOKIE['token']))) {
            return md5("the" . $_COOKIE['id'] . "prodigy") === $_COOKIE['token'];
        } else {
            return false;
        }
    }
    public function allCity() {
        $db = new \core\IDB();
        $what = '';
        $where = "";
        $orderColumn = "";
        $desc = "";
        $limit = "";
        //var_dump($page,$limit);
        $res = $db->select("city", $what, $where, $orderColumn, $desc, $limit);
        return $res;
    }
    public function getCity($get) {
        //var_dump($get);
        $db = new \core\IDB();
        $str = "SELECT * FROM `city` WHERE `city` LIKE '$get%'";
        $res = $db->sendQuery($str);
        return $res;
    }
}