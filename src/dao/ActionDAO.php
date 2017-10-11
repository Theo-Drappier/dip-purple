<?php

namespace DIP\dao;
use RedBeanPHP\R;
use DIP\tools\dao;

class ActionDAO extends dao
{
    private function __construct()
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

    public function findLastAction($idHomePiece)
    {
        $action = R::findOne($this->class, 'id_hp = '.$idHomePiece.' ORDER BY date DESC LIMIT 1');
        return $action;
    }

    public function findAllByToday($idHomePiece)
    {
        $todayAll = date('Y-m-d H:i:s');
        $today = date('Y-m-d');
        $actions = R::getAll('SELECT * FROM action
            WHERE id_hp = '.$idHomePiece.' AND action.date < "'.$todayAll.'" AND date(action.date) = "'.$today.'" ORDER BY date');
        return $actions;
    }

    public function findLastActionByDay($idHomePiece, $date)
    {
        $action = R::findOne($this->class,
            'id_hp = ? AND '.$this->class.'.date < ? ORDER BY date DESC LIMIT 1',
            [$idHomePiece, $date]);
        return $action;
    }

    public function getDiffTimeByDay($actions)
    {
        $dateJourStamp = date('Y-m-d H:i:s');
        $dateJour = date('Y-m-d');
        $result = [];
        $result['on'] = 0;
        $result['veille'] = 0;

        for($i = 0; $i < sizeof($actions); $i++)
        {
            $bareme = $actions[$i]['id_bareme'];
            if($i == 0)
            {
                if($bareme == 5)
                {
                    $dateJourExplode = explode('-', $dateJour);
                    $dateJourExplode[2] -= 1;
                    $dateHier = $dateJourExplode[0].'-'.$dateJourExplode[1].'-'.$dateJourExplode[2];
                    $actionHier = $this->findLastActionByDay($actions[0]['id_hp'], $dateHier);
                    if(!is_null($actionHier))
                    {
                        $baremeHier = $actionHier->id_bareme;
                    }
                    else {
                        $baremeHier = 3;
                    }
                    $dateTimeStart = $dateJour.' 00:00:00';
                    $dateTimeEnd = $actions[0]['date'];

                    $dateTime1 = date_create($dateTimeStart);
                    $dateTime2 = date_create($dateTimeEnd);
                    $interval = date_diff($dateTime1, $dateTime2);
                    if($baremeHier == 3)
                    {
                        $result['on'] += $interval->h;
                    }
                    else {
                        $result['veille'] += $interval->h;
                    }
                }
            }

            if($bareme != 5)
            {
                if(empty($actions[$i+1]))
                {
                    $dateTimeStart = $actions[$i]['date'];
                    $dateTimeEnd = $dateJourStamp;

                    $dateTime1 = date_create($dateTimeStart);
                    $dateTime2 = date_create($dateTimeEnd);
                    $interval = date_diff($dateTime1, $dateTime2);
                    if($actions[$i]['id_bareme'] == 3)
                    {
                        $result['on'] += $interval->h;
                    }
                    else {
                        $result['veille'] += $interval->h;
                    }
                }
                else {
                    $dateTimeStart = $actions[$i]['date'];
                    $dateTimeEnd = $actions[$i+1]['date'];

                    $dateTime1 = date_create($dateTimeStart);
                    $dateTime2 = date_create($dateTimeEnd);
                    $interval = date_diff($dateTime2, $dateTime1);

                    if($actions[$i]['id_bareme'] == 3)
                    {
                        $result['on'] += $interval->h;
                    }
                    else {
                        $result['veille'] += $interval->h;
                    }
                }
            }
        }

        return $result;
    }

    public function findAllByUser($user)
    {
        $actions = R::findAll($this->class, 'id_user = ?', [$user->id]);
        return $actions;
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
