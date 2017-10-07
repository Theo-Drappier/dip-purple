<?php

    namespace DIP\dao;

    use DIP\tools\dao;
    use RedBeanPHP\R;

    class UsersDAO extends dao
    {
        public function __construct()
        {
            $this->class = "users";
        }

        public static function getInstances()
        {
            if(!isset(self::$_instances['users']))
            {
                self::$_instances['users'] = new UsersDAO();
            }
            return self::$_instances['users'];
        }
    }

?>
