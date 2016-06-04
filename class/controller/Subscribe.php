<?php
namespace controller;


use core\Controller;

class Subscribe extends Controller {

    public function index()  {

        $idAutor = $_POST['idAutor'];
        $idUser = $_POST['idUser'];
        if ($idAutor && $idUser) {
            //echo "subscribe controller!! ".$_POST['idAutor']."   ".$_POST['idUser'];
            $this->model = new \model\Subscribe();
            $res = $this->model->subsUser($idUser,$idAutor);
            //echo " res $res";
        }
    }
    public function unsubs() {
        $idAutor = $_POST['idAutor'];
        $idUser = $_POST['idUser'];
        if ($idAutor && $idUser) {
            //echo "unsubscribe controller!! ".$_POST['idAutor']."   ".$_POST['idUser'];
            $this->model = new \model\Subscribe();
            $res = $this->model->unSubsUser($idUser,$idAutor);
            //echo " res $res";
        }
    }
    public function mySubs() {
        $this->model = new \model\Subscribe();
        $res = $this->model->mySubs($_SESSION['id']);
        $this->view = new \view\Subscribe();
        $this->view->mySubs($res);
        
    }

}