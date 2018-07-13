<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 14.02.2018
 * Time: 14:01
 */

class HomeModel extends Model
{
    public function getQuery()
    {
        $this->DB->select("*")->from("users");
        return (string) $this->DB;
    }
}