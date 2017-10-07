<?php

namespace Dip\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class HomeDAO extends dao
{
    private function _construct()
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
    public function getByName ($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }
            
}