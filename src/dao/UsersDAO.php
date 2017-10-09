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

        /*
         * Verify if the user login is correct
         */
        public function exists($mail, $password)
        {
            $pw = sha1($password);
            $result = R::findOne($this->class, 'mail = ? AND mdp = ?', [$mail, $pw]);
            return $result;
        }

        /*
         * Insert a new user
         */
        public function insert(array $newUser)
        {
            $user = R::dispense($this->class);
            $user->prenom = $newUser['prenom'];
            $user->nom = $newUser['nom'];
            $user->tablette = $newUser['is_tablette'];
            $user->pc = $newUser['is_pc'];
            $user->heure_debut = $newUser['heureDebut'];
            $user->heure_fin = $newUser['heureFin'];
            $user->mail = $newUser['mail'];
            $user->mdp = $newUser['password'];
            $user->telephone = $newUser['telephone'];
            R::store($user);
            return '200';
        }
    }
