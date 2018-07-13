<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 14.02.2018
 * Time: 14:01
 */

class HomeController extends Controller
{
    public function Entry() {
        extract($_POST);

        if (!empty($login)) {
            $login = strtolower($login);
            $user = new User();
            $user->auth($login);
        }

        if (!empty($code)) $this->Redirect("/$code");
        else $this->Redirect($_SERVER["HTTP_REFERER"]);
    }
}