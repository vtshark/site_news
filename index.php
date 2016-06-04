<?php
header("Content-type: text/html; charset=utf-8");
require_once "config.php";

//$obj = new core\Routing();
//var_dump($obj);
 //$arr = $obj->getPath();
//var_dump($arr);

core\Routing::rout();