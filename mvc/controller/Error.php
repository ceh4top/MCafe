<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 14.02.2018
 * Time: 17:28
 */

class ErrorController extends Controller
{
    public function display() {
        $name = $this->getName();
        $method = $_GET["method"];
        $title = $method;

        $path_view = "mvc/view/$name/" . $method . ".php";

        if (file_exists($path_view))
            require_once($path_view);
        else
            $this->Error();

        if (!empty($_COOKIE["RedirectMessage"]))
            setcookie("RedirectMessage", "", time() - 1);
    }
}