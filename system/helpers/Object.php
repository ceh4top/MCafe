<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 16.02.2018
 * Time: 14:11
 */

abstract class Object
{
    protected $DB = null;

    public function __construct() {
        $this->DB = System::getDataBase();

        $user = $this->getObject();

        if (!empty($user))
            foreach ($user as $key => $value)
                $this->{$key} = $value;
    }

    public abstract function getObject($key = null, $type = null);
    public abstract function getObjects();
    public abstract function Update($data);
    public abstract function Delete($id);
    public abstract function Insert($data);
    public abstract function isEmpty();
}