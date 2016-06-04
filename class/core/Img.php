<?php

namespace core;


class Img {
    public static function uploadFoto($uploadfile,$tmpfile,$w,$h) {
        $size = getimagesize($tmpfile);
        $koef = 1;
        if (($size[0]>$w) || ($size[0]>$h)) {
            if ($size[0]>$size[1])  {
                $koef=$w/$size[0];
            } else {
                $koef=$h/$size[1];
            }
            $w = (int)$size[0]*$koef;
            $h = (int)$size[1]*$koef;
        } else {
            $w = (int)$size[0];
            $h=(int)$size[1];
        }
        $new = imagecreatetruecolor($w,$h);
        //$im = imagecreatefromjpeg($tmpfile);
        $im = imagecreatefromstring(file_get_contents($tmpfile));
        imagecopyresampled($new,$im,0,0,0,0,$w,$h,$size[0],$size[1]);
        imagejpeg($new,$uploadfile);
    }
    public static function getAva($idUser) {
        $ava = "";
        $filename = SITE . "static/users/id/$idUser/profile/ava.jpg";
        //filename1 = "static\\users\\id\\$idUser\\profile\\ava.jpg";
        $filename1 = "static/users/id/$idUser/profile/ava.jpg";
        //$filename="static/users/id/{$idUserWall}/albums/{$id}/ava/ava.jpg";
        if (file_exists($filename1)) {
            $ava = '<img src=' . $filename . '>';
        }
        
        return $ava;
    }
    public static function getImgNews($idUser,$idNews) {
        $img = "";
        $filename = SITE . "static/users/id/$idUser/news/$idNews/ava.jpg";
        
        //$filename1 = "static\\users\\id\\$idUser\\news\\$idNews\\ava.jpg";
        $filename1 = "static/users/id/$idUser/news/$idNews/ava.jpg";
        
        if (file_exists($filename1)) {
            $img = '<img src=' . $filename . '>';
        }
        return $img;
    }

    public static function delImgNews($idUser,$idNews) {
        
        /*$filename1 = "static\\users\\id\\$idUser\\news\\$idNews\\ava.jpg";
        $dir = "static\\users\\id\\$idUser\\news\\$idNews";*/
        $filename = "static/users/id/$idUser/news/$idNews/ava.jpg";
        if (file_exists($filename)) {
            unlink($filename);    
        }
        
        $dir = "static/users/id/$idUser/news/$idNews";
        if (is_dir($dir)) {
            rmdir($dir);
        }
        
    }

    public static function addImg($file,$folder,$idUser,$idNews) {
        $error = "";
        $arrErrors = array(
            "Размер принятого файла превысил максимально допустимый размер - 5mb.",
            "Размер принятого файла превысил максимально допустимый размер - 5mb.",
            "Загружаемый файл был получен только частично.",
            "Файл не был загружен.",
            "отсутствует временная папка.",
            "Не удалось записать файл на диск",
            "PHP остановил загрузку файлов"
        );
        

        if ( $file['error'] == 0) {
            /*$dir = "static\\users\\id\\$idUser\\news\\$id";
            $uploadfile = "static\\users\\id\\$idUser\\news\\$id\\ava.jpg";*/
            

            $tmpfile = $file['tmp_name'];
            
            if ($folder == "news") {
                $dir = "static/users/id/$idUser/news/$idNews";
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $uploadfile = "static/users/id/$idUser/news/$idNews/ava.jpg";
                self::uploadFoto($uploadfile, $tmpfile, 500, 500);
                
            }
            if ($folder == "profile") {
                $dir = "static/users/id/$idUser/profile/";
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $uploadfile = "static/users/id/$idUser/profile/ava.jpg";
                self::uploadFoto($uploadfile, $tmpfile, 70, 70);
            }


        } else {
            $numErr = $file['error'];
            $error = "Ошибка загрузки фото! №$numErr." . $arrErrors[$numErr - 1];
        }
        return $error;
        
    }
        
}