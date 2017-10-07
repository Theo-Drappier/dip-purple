<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class HeurepcDAO extends dao
{
    private function __construct(){
        $this->class = "heurepc";
    }

    public static function getInstances()
    {
        if(!isset(self::$_instances['heurepc']))
        {
            self::$_instances['heurepc'] = new HeurepcDAO();
        }
        return self::$_instances['heurepc'];
    }

    /*public function getByName($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }*/
}
