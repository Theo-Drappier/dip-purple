<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class PieceDAO extends dao
{
    private function __construct(){
        $this->class = "piece";
    }

    public static function getInstances()
    {
        if(!isset(self::$_instances['piece']))
        {
            self::$_instances['piece'] = new PieceDAO();
        }
        return self::$_instances['piece'];
    }

    /*public function getByName($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }*/
}
?>

