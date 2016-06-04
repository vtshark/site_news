<?php

namespace core;


class Routing {
    public static function getPath() {
        $path = $_SERVER['REQUEST_URI'];
        $arr = explode("/",$path);
        //var_dump($arr);
        /*$classNum = 1;
        $methodNum = 2;
        $paramNum = 3;*/
        $classNum = 2;
        $methodNum = 3;
        $paramNum = 4;
        $className = $metName = $param = false;
        if (isset($arr[$classNum])) {
            $className = $arr[$classNum];
        }
        if (isset($arr[$methodNum])) {
            $metName = $arr[$methodNum];
        }
        $i = $paramNum;
        while (isset($arr[$i])) {
            $param[] = $arr[$i];    
            $i++;
        }
            //var_dump($param);

        $resArr = [$className,$metName,$param];
        return $resArr;
    }
    public static function rout() {

        $arr = self::getPath();
        $className = $arr[0] ? ucfirst($arr[0]) : "News";
        $metName = $arr[1] ? $arr[1] : "index";
        $param = $arr[2] ? $arr[2] : null;
        $className = "\\controller\\".$className;
        //echo "<br/>$className $metName $param<br/>";
        if (class_exists($className)) {
            $obj = new $className();
            if (method_exists($obj,$metName)) {
                $obj->$metName($param);
            } else {
                //echo "<br/>404<br/>";
                $obj->index();
            }
        } else {
            echo "<br/>404<br/>";
        }
    }
}