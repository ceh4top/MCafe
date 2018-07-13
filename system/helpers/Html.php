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
    private static $Less = array();
    private static $Scripts = array();

    public static function Styles($src = null) {
        if (!empty($src)) {
            if (substr($src, -4, 4) == "less")
                Html::$Styles[] = "<link rel=\"stylesheet/less\" type=\"text/css\" href=\"$src\" />";
            else
                Html::$Styles[] = "<link rel=\"stylesheet\" href=\"$src\">";
        }

        return implode("\n", Html::$Styles);
    }

    public static function Less($src = null) {
        if (!empty($src))

        return implode("\n", Html::$Less);
    }

    public static function Scripts($src = null) {
        if (!empty($src))
            Html::$Scripts[] = "<script src=\"$src\"></script>";

        return implode("\n", Html::$Scripts);
    }
}