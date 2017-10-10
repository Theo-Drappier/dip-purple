<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class IconeDAO extends dao
{
    private function __construct()
    {
        $this->class = 'icone';
    }
    
    public static function getInstances()
    {
        if(!isset(self::$_instances['icone']))
        {
            self::$_instances['icone']= new IconeDAO();
        }
        return self::$_instances['icone'];

    }
}
