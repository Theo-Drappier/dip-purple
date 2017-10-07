<?php

    namespace DIP\dao;
    use RedBeanPHP\R;
    use DIP\tools\dao;

    class AbonnementDAO extends dao
    {
        public function __construct()
        {
            $this->class = "abonnement";
        }
        public static function getInstances()
        {
            if(!isset(self::$_instances['abonnement']))
            {
                self::$_instances['abonnement'] = new AbonnementDAO();
            }
            return self::$_instances['abonnement'];
        }

        public function findByMontant($montant)
        {
          $abonnement = R::find($this->class, 'montant = '.$montant);
          return $abonnement;
        }
    }
