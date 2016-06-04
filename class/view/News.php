<?php

namespace view;


class News {
    public function allNews($news,$page = 1,$rootNews,$idAutor)
    {
        $idUser = isset($_SESSION['id']) ? $_SESSION['id'] : "";
        if ($rootNews == 'news/allNews/') {
            $titlePage = "Site News";
        }   else {
            $titlePage = "Мои публикации";
        }
        
        //$titlePage = "Site News";
        
        $arr = \model\Profile::getProfile();
        $user = "";
        if ($arr) {
            $user = $arr['name'] . " " . $arr['second_name'];
        }
        $numPages = "";

        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/numPages.php";
        include "templates/forms/allNews.php";
        include "templates/forms/numPages.php";
        include "templates/footer.php";
    }
    public function addForm($error = null,$news = null) {
        //var_dump($news);
        $titlePage = "Редактирование";
        $id = $text = $title = $ava = "";
        if ($news) {
            $title = $news['title'];
            $text = $news['text'];
            $ava = \core\Img::getAva($news['id'],"news");
            $id = $news['id'];
        }

        if (isset($_SESSION['id'])) {
            $arr = \model\Profile::getProfile();
            $user = $arr['name'] . " " . $arr['second_name'];
            $idUser = $_SESSION['id'];
        } else {
            $user = "";
        }
        $date = date("");
        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/addNewsForm.php";
        include "templates/footer.php";
    }
    public function id($news,$comm) {
        $id = $text = $title = $ava = $user = "";
        $titlePage = $title = $news['title'];
        $text = $news['text'];
        $id = $news['id'];
        $date = $news['date'];
        $idAutor = $news['idUser'];
        $avaNews = \core\Img::getImgNews($idAutor,$id);

        $ava = \core\Img::getAva($idAutor);
        $arr = \model\Profile::getProfile($idAutor);
        $autor = $arr['name'] . " " . $arr['second_name'];

        if (isset($_SESSION['id'])) {
            $idUser = $_SESSION['id'];
            $arr = \model\Profile::getProfile($idUser);
            if ($arr) {
                $user = $arr['name'] . " " . $arr['second_name'];
            }
        }

        //comments
        $arrComm = [];
        foreach ($comm['comm'] as $v) {
            $arrComm[$v['id']]['time'] = $v['time'];
            $arr = \model\Profile::getProfile($v['idUser']);
            $arrComm[$v['id']]['autor'] = $arr['name'] . " " . $arr['second_name'];
            $arrComm[$v['id']]['ava'] = \core\Img::getAva($v['idUser']);
            $arrComm[$v['id']]['text'] = $v['text'];
        }

        include "templates/head.php";
        include "templates/header.php";
        include "templates/forms/idNews.php";
        include "templates/forms/comments.php";
        include "templates/footer.php";
    }
}