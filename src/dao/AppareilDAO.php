<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class AppareilDAO extends dao
{
    private function __construct()
    {
        $this->class = 'appareil';
    }
    public static function getInstances()
    {
        if(!isset(self::$_instances['appareil']))
        {
            self::$_instances['appareil']= new AppareilDAO();
        }
        return self::$_instances['appareil'];

    }
    public function getByName ($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }

}
