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
    public function findAllByHomePiece($idHome, $idPiece)
    {
        $homepiece = R::findAll($this->class, 'id_home = ? AND id_piece = ?', [$idHome, $idPiece]);
        $result = [];
        foreach($homepiece as $hp)
        {
            $result[] = $hp;
        }
        return $result;
    }
    public function findAllByHome($idHome)
    {
        $homepiece = R::findAll($this->class, 'id_home = ?', [$idHome]);
        $result = [];
        foreach($homepiece as $hp)
        {
            $result[] = $hp;
        }
        return $result;
    }
    /*public function getByName($name)
    {
        $result = R::find($this->class, 'name = ?',[$name]);
        return $result;
    }*/
}
