<?php

namespace model;

class Subscribe {
    public function subsUser($idUser,$idAutor) {
       
        $db = new \core\IDB();
        $id = $db->insert("subscribe",["id_user" => $idUser,
                        "id_autor" => $idAutor]);
        return "Вы подписались! $idUser $idAutor";
    }

    public function unSubsUser($idUser,$idAutor) {
       
        $where = ["id_user" => $idUser,"id_autor" => $idAutor];
        $db = new \core\IDB();
        $db->delete("subscribe", $where);

        return "Вы отписались! $idUser $idAutor";
    }

    public function MySubs($idUser) {
        
        $res = null;

        $db = new \core\IDB();
        $what = '';
        $where = ["id_user"=>$idUser];
        $orderColumn = "";
        $desc = "";
        $limit = "";
        $res = $db->select("subscribe", $what, $where, $orderColumn, $desc, $limit);
        $arr = [];
        foreach ($res as $v) {
            $buf = \model\Profile::getProfile($v['id_autor']);
            //var_dump($buf);
            //echo "<br/>";
            $arr[] = $buf;
        }
        return $arr;
    }

    public static function ifSubsUser($idUser,$idAutor) {
       
        $db = new \core\IDB();
        $what = '';
        $where = ["id_user" => $idUser,"id_autor" => $idAutor];
        $orderColumn = "";
        $desc = "";
        $limit = [0,1];
        $res = $db->select("subscribe", $what, $where, $orderColumn, $desc, $limit);

        return $res ? true : false;

    }    
}