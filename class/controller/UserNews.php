<?php

namespace controller;

use core\Controller;

class UserNEws extends Controller {
    public function __construct() {
        if (!isset($_SESSION['id'])) {
            header("location: ".ROOT);
        }
    }
    function index() {
        $this->allNews(null);
    }
    public function allNews($param) {
        $page = isset($param[0]) ? $param[0] : 1;
        $idUser = isset($param[1]) ? $param[1] : $_SESSION['id'];
        $this->model = new \model\News();
        $res = $this->model->userNews($page,$idUser);
        $this->view = new \view\News();
        $this->view->allNews($res,$page,"userNews/allNews/",$idUser);
    }
    
    public function addForm($param) {
        //var_dump($id);
        $id = isset($param[0]) ? $param[0] : "";
        $res = "";
        $error = null;
        if ($id) {
            $this->model = new \model\News();
            $res = $this->model->getNews($id);
            $idUser = isset($_SESSION['id']) ? $_SESSION['id'] : "";
            if ($res['idUser'] != $idUser ) {
                //$error[] = "Вы не являетесь автором данной статьи!";
                header("location: ".ROOT."userNews/addForm/");
            }
        }
        $this->view = new \view\News();
        $this->view->addForm($error,$res);
    }
    
    public function add() {
        
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
   
    public function del($param) {
        
        $id = isset($param[0]) ? $param[0] : "";
        $this->model = new \model\News();

        if (isset($_SESSION['id'])) {

            $idUser = $_SESSION['id'];
            $this->model->delNews($id, $idUser);
            \model\Comments::delNews($id);
        }
        $this->allNews(null);
    
    }
    
    public function delImg($param) {
        $idNews = isset($param[0]) ? $param[0] : "";
        if (isset($_SESSION['id']) &&  $idNews) {
            \core\Img::delImgNews($_SESSION['id'],$idNews);
            header("location: ".ROOT."userNews/addForm/$idNews");
        }
    }
}