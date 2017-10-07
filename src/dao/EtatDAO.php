<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class EtatDAO extends dao
{
    private function __construct(){
        $this->class = "etat";
    }

    public static function getInstances()
    {
        if(!isset(self::$_instances['etat']))
        {
            self::$_instances['etat'] = new EtatDAO();
        }
        return self::$_instances['etat'];
    }

    /*public function getByName($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }*/
}
