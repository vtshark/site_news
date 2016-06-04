<?php

namespace model;


class News {
    public function add() {

        $title = $_POST['title'];
        $text = $_POST['text'];
        $idUser = $_SESSION['id'];
        $error = [];

        if ($title!="" && $text!="") {

            $db = new \core\IDB();
            $idNews = $db->insert("news",
                ["title" => $title,
                    "text" => $text,
                    "idUser" => $idUser]);

            $errImg = \core\Img::addImg($_FILES['userfile'],"news",$idUser,$idNews);
            if ($errImg) {
                $error[] = "Новость добавлена! " .$errImg;
            }

        } else {
            $error[] = "Заполнены не все пеквизиты!";
        }
        return $error;
    }

    public function update($idNews) {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $idUser = $_SESSION['id'];
        $error = [];

        if ($title!="" && $text!="") {

            $db = new \core\IDB();
            $db->update("news",["title" => $title,"text" => $text],["id" => $idNews]);

            $errImg = \core\Img::addImg($_FILES['userfile'],"news",$idUser,$idNews);
            if ($errImg) {
                $error[] = "Новость сохранена! " .$errImg;
            }

        } else {
            $error[] = "Заполнены не все пеквизиты!";
        }
        return $error;
    }

    public function allNews($page = 1) {
        $db = new \core\IDB();
        $what = '';
        $where = "";
        $orderColumn = "id";
        $desc = "DESC";
        $limit = [($page-1)*5,5];
        //var_dump($page,$limit);
        $res = $db->select("news", $what, $where, $orderColumn, $desc, $limit);
        return $res;
    }
    public static function countAllNews() {
        $db = new \core\IDB();
        $res = $db->countAllrec("news","");
        return $res;
    }
    public static function countUserNews($idUser) {
        $db = new \core\IDB();
        $where = ['idUser' => $idUser];
        $res = $db->countAllrec("news",$where);
        return $res;
    }
    public function userNews($page = 1, $idUser) {
        $res = "";

        $db = new \core\IDB();
        $what = '';
        $where = ['idUser' => $idUser];
        $orderColumn = "id";
        $desc = "DESC";
        $limit = [($page-1)*5,5];
        //var_dump($page,$limit);
        $res = $db->select("news", $what, $where, $orderColumn, $desc, $limit);

        return $res;
    }
    public function delNews($id = "", $idUser = "") {
        if ($id!="" && $idUser) {
            $where = ["id" => $id,"idUser" => $idUser];
            $db = new \core\IDB();
            $db->delete("news", $where);
            \core\Img::delImgNews($idUser,$id);
        }
    }
    public function getNews($id = null) {
        $res = null;
        if ($id) {
            $db = new \core\IDB();
            $what = '';
            $where = ['id' => $id];
            $orderColumn = "";
            $desc = "";
            $limit = [0,1];
            $res = $db->select("news", $what, $where, $orderColumn, $desc, $limit);
        }
        return $res[0];
    }
}
