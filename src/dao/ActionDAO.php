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
        
        public function insert(array $action)
        {
            $newAction = R::dispense($this->class);
            $newAction->date=date("Y-m-d H:i:s");
            $newAction->id_user=$action["user"]->id;
            $newAction->id_hp= $action["id_hp"];
            $newAction->id_bareme=$action["statuApp"];
            R::store($newAction);
        }
    }
