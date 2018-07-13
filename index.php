<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 11.02.2018
 * Time: 20:45
 */

require_once("system/System.php");

foreach (System::getFiles("system/helpers") as $file)
    require_once("system/helpers/$file");

foreach (System::getFiles("system/objects") as $file)
    require_once("system/objects/$file");

foreach (System::getFiles("helper", ".php") as $file)
    require_once("helper/$file");

foreach (System::getFiles("system/mvc", ".php") as $file)
    require_once("system/mvc/$file");

class ROOT {
    public function __construct() {
        $task = ucfirst($_GET["task"]);
        $controller = ucfirst($_GET["controller"]);
        $controller_name = null;

        $view = ucfirst($_GET["view"]);
        $method = ucfirst($_GET["method"]);

        if (empty($task) || empty($method)) {
            $view = (empty($view))?"Main":$view;

            $controller_name = (empty($controller))?"Home":$controller;
            $controller = $controller_name."Controller";
        }
        else {
            $view = null;
            $controller_name = $task;
            $controller = $controller_name."Controller";
        }

        $path_file = "mvc/controller/$controller_name.php";

        if (file_exists($path_file)) {
            require_once($path_file);

            $controller = new $controller();
            if (!empty($view)) $controller->display($view);
            else $controller->$method();
        }
        else System::Error();
    }
}
new ROOT();