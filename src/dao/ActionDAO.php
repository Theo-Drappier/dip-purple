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

    public function findLastActions($idHomePiece)
    {
        $action = R::getAll('SELECT * FROM action
            WHERE id_hp = '.$idHomePiece.' ORDER BY date DESC LIMIT 3');
        return $action;
    }

    public function findLastAction($idHomePiece)
    {
        $action = R::findOne($this->class, 'id_hp = '.$idHomePiece.' ORDER BY date DESC LIMIT 1');
        return $action;
    }

    public function getDiffTime($actions)
    {
        $dateJourStamp = date('Y-m-d H:i:s');
        $dateJour = date('Y-m-d');

        $bareme1 = $actions[0]['id_bareme'];
        if(isset($actions[1]['id_bareme'])){
            $bareme2 = $actions[1]['id_bareme'];
        }
        if(isset($actions[2]['id_bareme'])){
            $bareme3 = $actions[2]['id_bareme'];
        }

        if($bareme1 == 3 || $bareme1 == 4){
            $dateTimeStart = $actions[0]['date'];
            $dateTimeEnd = $dateJourStamp;
        }
        if($bareme1 == 5){
            $dateTimeStart = $actions[1]['date'];
            $dateTimeEnd = $actions[0]['date'];
        }


        $dateTimeStartExplode = explode(' ', $dateTimeStart);
        $dateTimeEndExplode = explode(' ', $dateTimeEnd);

        $dateStart = explode('-', $dateTimeStartExplode[0]);
        $dateEnd = explode('-', $dateTimeEndExplode[0]);

        $dateTimeStartFinal = null;
        if($dateJour == $dateTimeEndExplode[0])
        {
            if($dateStart[1] == $dateEnd[1])
            {
                if($dateStart[2] != $dateEnd[2])
                {
                    $dateStart[2] = $dateEnd[2];
                    $dateTimeStartExplode[1] = "00:00:00";
                    $dateTimeStartExplode[0] = $dateStart[0].'-'.$dateStart[1].'-'.$dateStart[2];
                    $dateTimeStart = $dateTimeStartExplode[0].' '.$dateTimeStartExplode[1];
                }
            }
            $datetime1 = date_create($dateTimeStart);
            $datetime2 = date_create($dateTimeEnd);
            $interval = date_diff($datetime1, $datetime2);

            return $interval->h;
        }else{
            $interval = 0;
            return $interval;
        }


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
