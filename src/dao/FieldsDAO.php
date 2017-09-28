<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class FieldsDAO extends dao
{
    private function __construct(){
        $this->class = "fields";
    }

    public static function getInstances()
    {
        if(!isset(self::$_instances['fields']))
        {
            self::$_instances['fields'] = new FieldsDAO();
        }
        return self::$_instances['fields'];
    }

    public function getByName($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }
}
?>
