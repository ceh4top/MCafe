<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 13.02.2018
 * Time: 8:42
 */

abstract class Controller
{
    /**
     * @param $view
     */
    public function display($view) {
        $name = $this->getName();

        $path_view = "mvc/view/$name/" . $view . ".php";

        $model = $this->getModel();

        $title = $view . " / " . $name . " / " . "MCafe";
        $items = $model->getItems();
        $user = new User();
        $message = $_COOKIE["RedirectMessage"];

        Html::Styles("/STYLE/system/bootstrap.min.css");
        Html::Styles("/STYLE/system.min.css");
        Html::Styles("/STYLE/layout/$name.min.css");
        Html::Styles("/STYLE/$name/$view.min.css");
        Html::Styles("/STYLE/system/fontawesome/css/all.css");

        Html::Scripts("/SCRIPT/system/jquery-3.3.1.min.js");
        Html::Scripts("/SCRIPT/system/modernizr.2.5.3.min.js");
        Html::Scripts("/SCRIPT/system/popper.min.js");
        Html::Scripts("/SCRIPT/system/bootstrap.min.js");

        /*if ($view == "Menu" && $name == "Home") {
            Html::Scripts("/SCRIPT/system/turn/turn.min.js");
            Html::Scripts("/SCRIPT/system/turn/turn.html4.min.js");
        }*/

        Html::Scripts("/SCRIPT/layout/$name.js");
        Html::Scripts("/SCRIPT/$name/$view.js");
        //Html::Scripts("//cdnjs.cloudflare.com/ajax/libs/less.js/3.7.0/less.min.js");

        if (file_exists($path_view)) {
            require_once("template/Header.php");
            require_once($path_view);
            require_once("template/Footer.php");
        }
        else
            System::Error();

        if (!empty($message))
            setcookie("RedirectMessage", "", time() - 1);
    }

    /**
     * @return mixed
     */
    protected function getName() {
        return str_replace("Controller", "", get_class($this));
    }

    /**
     * @param null $name
     * @return null
     */
    protected function getModel($name = null) {
        if (empty($name))
            $name = $this->getName();

        $name_model = $name . "Model";
        $path_model = "mvc/model/$name.php";
        if (file_exists($path_model)) {
            require_once($path_model);
            return new $name_model();
        } else return null;
    }

    /**
     * @param $href
     * @param null $message
     */
    protected function Redirect($href, $message = null) {
        $time = time() + 60 * 60;
        setcookie("RedirectMessage", $message, $time);
        header("Location: $href");
        exit();
    }
}