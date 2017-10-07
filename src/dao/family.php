<?php

namespace Dip\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class FamilyDAO extends dao
{
    private function _construct()
    {
        $this->class = 'family';
    }
    public static function getInstances() 
    {
        if(!isset(self::$_instances['family']))
        {
            self::$_instances['family']= new FamilyDAO();
        }
        return self::$_instances['family'];
     
    }            
}
