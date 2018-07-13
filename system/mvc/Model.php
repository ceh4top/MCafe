<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 13.02.2018
 * Time: 8:43
 */

abstract class Model
{
    protected $DB = null;

    public function __construct() {
        $this->DB = System::getDataBase();
    }

    public function getItems() {
        return $this->DB->getObjectList($this->getQuery());
    }

    protected abstract function getQuery();
}