<?php

namespace DIP\dao;
use DIP\tools\dao;
use RedBeanPHP\R;

class FamilyDAO extends dao
{
    private function __construct()
    {
        $this->class = 'family';
    }

    public static function getInstances()
    {
        if(!isset(self::$_instances['family']))
        {
            self::$_instances['family']= new FamilyDAO();
        }
        return self::$_instances['family'];

    }

    public function getBestHunter($users)
    {
        $actionDAO = ActionDAO::getInstances();
        $baremeDAO = BaremeDAO::getInstances();
        $pointsUser = [];
        foreach($users as $u)
        {
            $actionsUser = $actionDAO->findAllByUser($u);
            $pointsUser[$u->id] = $baremeDAO->getSumPointByUser($actionsUser);
        }

        arsort($pointsUser);
        return $pointsUser;
    }
}
