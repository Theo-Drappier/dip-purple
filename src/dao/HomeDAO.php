<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class HomeDAO extends dao
{
    private function __construct()
    {
        $this->class = 'home';
    }
    public static function getInstances()
    {
        if(!isset(self::$_instances['home']))
        {
            self::$_instances['home']= new HomeDAO();
        }
        return self::$_instances['home'];

    }
}
