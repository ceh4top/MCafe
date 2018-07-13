<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 16.02.2018
 * Time: 13:18
 */

class User extends Object
{
    public function getObject($key = null, $type = "login")
    {
        if (empty($login)) $login = $_COOKIE["user"];
        if (empty($login)) return null;

        $this->DB->select("*")->from("users")
            ->where("$type = '$login'");
        return $this->DB->getObject();
    }

    public function getObjects()
    {
        $this->DB->select("*")->from("users");
        return $this->DB->getObjectList();
    }

    public function Update($data)
    {
        foreach ($data as $key => $value)
            $this->DB->set("$key = '$value'");

        $this->DB->update("users")->where("id = '$data->id'");
        return $this->DB->execute();
    }

    public function Delete($id)
    {
        $this->DB->delete("users")->where("id = '$id'");
        return $this->DB->execute();
    }

    public function Insert($data)
    {
        $columns = array();
        $values = array();
        foreach ($data as $key => $value) {
            $columns[] = $key;
            $values[] = "'$value'";
        }

        $this->DB->insert("users")
            ->columns(implode(", ", $columns))
            ->values(implode(", ", $values));

        return $this->DB->execute();
    }

    public function isEmpty()
    {
        return empty($this->id);
    }

    public function auth($login) {
        setcookie("user", $login, time() + 3 * 24 * 60 * 60, "/");
        $user = $this->getObject($login, "login");
        if (empty($user))
            $this->Insert(array("login" => $login));
    }
}