<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class BaremeDAO extends dao
{
    private function __construct()
    {
        $this->class = 'bareme';
    }
    
    public static function getInstances()
    {
        if(!isset(self::$_instances['bareme']))
        {
            self::$_instances['bareme']= new BaremeDAO();
        }
        return self::$_instances['bareme'];

    }
}
