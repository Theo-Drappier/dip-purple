<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class HomePieceDAO extends dao
{
    private function __construct(){
        $this->class = "homepiece";
    }

    public static function getInstances()
    {
        if(!isset(self::$_instances['homepiece']))
        {
            self::$_instances['homepiece'] = new HomePieceDAO();
        }
        return self::$_instances['homepiece'];
    }

    public function getByFam($idFam){
        $homepieces = R::getAll('SELECT * FROM '.$this->class.' WHERE id_home = '.$idFam);
        return $homepieces;
        
    }
}
