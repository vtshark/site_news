<?php

namespace controller;

use core\Controller;

class MyNews extends Controller {
    public function __construct() {
        if (!isset($_SESSION['id'])) {
            header("location: ".ROOT);
        }
    }
    function index() {
        $this->allNews($page = 1);
    }
    public function allNews($page = 1) {
        $this->model = new \model\News();
        $res = $this->model->myNews($page);
        $this->view = new \view\News();
        $this->view->allNews($res,$page,"myNews/allNews/");
    }
    public function addForm($id = null) {
        $res = "";
        $error = null;
        if ($id) {
            $this->model = new \model\News();
            $res = $this->model->getNews($id);
        }
        $this->view = new \view\News();
        $this->view->addForm($error,$res);
    }
    public function add($id = null) {
        $idNews = $_POST['id'];
        $this->model = new \model\News();
        if (!$idNews) {
            $error = $this->model->add();
        } else {
            $error = $this->model->update($idNews);
        }
        if (!$error) {
            $this->index();
        } else {
            $this->view = new \view\News();
            if ($idNews) {
                $res = $this->model->getNews($idNews);
            } else {
                $res = "";
            }
            $this->view->addForm($error, $res);
        }
    }
    public function del($id) {
        $this->model = new \model\News();

        if (isset($_SESSION['id'])) {

            $idUser = $_SESSION['id'];
            $this->model->delNews($id, $idUser);
        }
        $this->allNews();
    }
    public function delImg($idNews) {
        if (isset($_SESSION['id'])) {
            \core\Img::delImgNews($_SESSION['id'],$idNews);
            header("location: ".ROOT."myNews/addForm/$idNews");
        }
    }
}