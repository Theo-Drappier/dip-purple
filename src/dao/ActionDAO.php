<?php

    namespace DIP\dao;
    use RedBeanPHP\R;
    use DIP\tools\dao;

    class ActionDAO extends dao
    {
        public function __construct()
        {
            $this->class = "action";
        }
        
        public static function getInstances()
        {
            if(!isset(self::$_instances['action']))
            {
                self::$_instances['action'] = new ActionDAO();
            }
            return self::$_instances['action'];
        }
        
        public function getTotalConsoByFam($idFam)
        {
            $homePiece = new HomePieceDAO();
            $homePieces = $homePiece->getByFam($idFam);
            
            foreach($homePieces as $hp)
            {
                //$action = R::getAll("SELECT MAX(`date`) FROM ".$this->class." WHERE id_hp=".$hp->id);
                //if()
            }
        }
    }
