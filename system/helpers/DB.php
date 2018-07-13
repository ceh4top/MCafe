<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 11.02.2018
 * Time: 19:42
 */

class DB
{
    private $DB = null;
    private $QUERY = null;

    public function __construct() {
        $this->DB = mysqli_connect("localhost", "root", "", "mcafe");
        $this->clear();
    }

    public function getMysqli() {
        return $this->DB;
    }

    private function clear() {
        $this->QUERY = (object) array(
            'insert' => null,
            'select' => array(),
            'delete' => null,
            'update' => null,
            'set' => array(),
            'columns' => null,
            'values' => array(),
            'from' => null,
            'join' => array(),
            'where' => array(),
            'group' => array(),
            'having' => array(),
            'order' => array()
        );
    }

    public function insert($query) {
        $this->QUERY->insert = $query;
        return $this;
    }
    public function select($query) {
        $this->QUERY->select[] = $query;
        return $this;
    }
    public function delete($query) {
        $this->QUERY->delete = $query;
        return $this;
    }
    public function update($query) {
        $this->QUERY->update = $query;
        return $this;
    }
    public function set($query) {
        $this->QUERY->set[] = $query;
        return $this;
    }
    public function columns($query) {
        $this->QUERY->columns = $query;
        return $this;
    }
    public function values($query) {
        $this->QUERY->values[] = $query;
        return $this;
    }
    public function from($query) {
        $this->QUERY->from = $query;
        return $this;
    }
    public function join($type, $query) {
        $this->QUERY->join[] = (object) array("type" => $type, 'query' => $query);
        return $this;
    }
    public function where($query) {
        $this->QUERY->where[] = $query;
        return $this;
    }
    public function group($query) {
        $this->QUERY->group[] = $query;
        return $this;
    }
    public function having($query) {
        $this->QUERY->having[] = $query;
        return $this;
    }
    public function order($query) {
        $this->QUERY->order[] = $query;
        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $QUERY = "";
        $W = $this->QUERY;
        if (!empty($W->insert))
            $QUERY .= "INSERT INTO $W->insert";
        if (!empty($W->select))
            $QUERY .= "SELECT " . implode(", ", $W->select);
        if (!empty($W->delete))
            $QUERY .= "DELETE FROM $W->delete";
        if (!empty($W->update))
            $QUERY .= "UPDATE $W->update";
        if (!empty($W->set))
            $QUERY .= " SET" . implode(", ", $W->set);
        if (!empty($W->columns))
            $QUERY .= " ($W->columns)";
        if (!empty($W->values)) {
            $QUERY .= " VALUES";
            foreach ($W->values as $key => $value)
                $QUERY .= " ($value)" . ((count($W->values) - 1 > $key)?",":"");
        }
        if (!empty($W->from))
            $QUERY .= " FROM $W->from";
        foreach ($W->join as $join)
            $QUERY .= " $join->type JOIN $join->query";
        if (!empty($W->where))
            $QUERY .= " WHERE " . implode(" AND ", $W->where);
        if (!empty($W->group))
            $QUERY .= " GROUP BY " .implode(", ", $W->group);
        if (!empty($W->having))
            $QUERY .= " HAVING " . implode(", ", $W->having);
        if (!empty($W->order))
            $QUERY .= " ORDER BY " . implode(", ", $W->order);

        return $QUERY;
    }
    public function getObject($QUERY = null) {
        if (empty($QUERY)) $QUERY = (string) $this;
        $this->clear();
        $QUERY = $this->DB->query($QUERY);
        return (empty($QUERY))?null:$QUERY->fetch_object();
    }
    public function getObjectList($QUERY = null) {
        if (empty($QUERY)) $QUERY = (string) $this;
        $this->clear();
        $QUERY = $this->DB->query($QUERY);
        $RESULT = array();
        if (!empty($QUERY))
            while ($R = $QUERY->fetch_object())
                $RESULT[] = $R;
        return $RESULT;
    }
    public function execute($QUERY = null) {
        if (empty($QUERY)) $QUERY = (string) $this;
        $this->clear();
        return $this->DB->query($QUERY);
    }
    public function getInsertId() {
        return $this->DB->insert_id;
    }
}