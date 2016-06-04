<?php

namespace model;


class Comments {
    public function getComments($idNews) {
        $res = null;
        if ($idNews) {
            $db = new \core\IDB();
            $what = '';
            $where = ['idNews' => $idNews];
            $orderColumn = "";
            $desc = "";
            $limit = "";
            $res = $db->select("comments", $what, $where, $orderColumn, $desc, $limit);
        }
        return $res;
    }
    public function add($idNews,$idUser,$text) {
        if ($idNews && $idUser && $text) {
            $db = new \core\IDB();
            $idNews = $db->insert("comments",
                ["idNews" => $idNews,
                    "text" => htmlspecialchars($text),
                    "idUser" => $idUser]);
        }
    }
    public static function delNews($idNews) {
        if ($idNews) {
            $where = ["idNews" => $idNews];
            $db = new \core\IDB();
            $db->delete("comments", $where);
        }
    }
}