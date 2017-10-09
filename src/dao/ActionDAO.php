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
    }
