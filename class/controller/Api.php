<?php

namespace controller;


use core\Controller;

class Api extends Controller {

    public function index() {
        $this->view = new \view\Api();
        $this->view->infoApi();
    }
    
    public function allNews($param) {
        $this->model = new \model\News();
        $page = isset($param) ? $param[0] : 1;
        echo json_encode($this->model->allNews($page));
    }
    
    public function userNews($param) {
        //echo "api";
        if (isset($param)) {
            $this->model = new \model\News();
            $page = $param[0];
            $idUser = $param[1];
            echo json_encode($this->model->userNews($page,$idUser));
            // вставить в хедер перед выводом "content-type: application/json".... !!!!
        }
    }
    
    public function idNews($param) {
        if (isset($param)) {
            $this->model = new \model\News();
            $idNews = $param[0];
            
            $res = $this->model->getNews($idNews);
            echo json_encode($res);
        }
    }
    
    public function getAllUsers() {
        $this->model = new \model\Profile();
            $res = $this->model->getAllUsers();
            echo json_encode($res);
    }
    public function getProfile($param) {
        if (isset($param)) {
            $idUser = $param[0];
            $this->model = new \model\Profile();
            $res = $this->model->getProfile($idUser);
            echo json_encode($res);
        }
    }
    public function subsUser($param) {
        if (isset($param)) {
            $idUser = $param[0];
            $this->model = new \model\Subscribe();
            $res = $this->model->MySubs($idUser);
            echo json_encode($res);
        }
    }
    public function getAllCity($param) {
        if (!$param) {
            //$this->model = new \model\User();
            //$res = $this->model->allCity();
            //echo json_encode($res);
        } else {
            if ($param[0]) {
                $this->model = new \model\User();
                $res = $this->model->getCity($param[0]);
                echo json_encode($res);
            }
        }
    }
}