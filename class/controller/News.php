<?php

namespace controller;


use core\Controller;

class News extends Controller {

    public function index() {
        $this->allNews(null);
    }
    public function allNews($param) {
        $page = isset($param[0]) ? $param[0] : 1;
        $this->model = new \model\News();
        $res = $this->model->allNews($page);
        $this->view = new \view\News();
        $this->view->allNews($res,$page,"news/allNews/",null);
    }
    public function id($param) {
        $id = isset($param[0]) ? $param[0] : "";
        if ($id) {
            $this->model = new \model\News();
            $res = $this->model->getNews($id);

            //добавление комментария
            $objComm = new \model\Comments();
            if (isset($_POST['text']) && isset($_SESSION['id'])) {
                $comm['err'] = $objComm->add($id,$_SESSION['id'],$_POST['text']);
            }
            $comm['comm'] = $objComm->getComments($id);
            $this->view = new \view\News();
            $this->view->id($res,$comm);
        }
    }
}