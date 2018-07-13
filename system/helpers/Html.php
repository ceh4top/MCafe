<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 11.02.2018
 * Time: 19:42
 */

class Html
{
    private static $Styles = array();
    private static $Scripts = array();

    public static function Styles($src = null) {
        if (!empty($src))
            Html::$Styles[] = "<link rel=\"stylesheet\" href=\"$src\">";

        return implode("\n", Html::$Styles);
    }

    public static function Scripts($src = null) {
        if (!empty($src))
            Html::$Scripts[] = "<script src=\"$src\"></script>";

        return implode("\n", Html::$Scripts);
    }
}