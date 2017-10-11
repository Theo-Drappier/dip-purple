<?php

$app->get('/piece/{idPiece}', function($request, $response, $args) use ($services, $app)
{
    if($_SESSION['is_user'])
    {
        ob_start();

        $home = $services['dao.home']->findOneByIdFamily($_SESSION['famille']->id);
        $piece = $services['dao.piece']->findOneById($args['idPiece']);
        $homepieces = $services['dao.homepiece']->findAllByHomePiece($home->id, $piece->id);

        $appareils = [];
        $actions = [];
        $etats = [];
        $consoPiece = 0;
        $consoAppareils = [];

        for($i = 0; $i < sizeof($homepieces); $i++)
        {
            $actions[] = $services['dao.action']->findAllByToday($homepieces[$i]->id);
            $action = $services['dao.action']->findLastAction($homepieces[$i]->id);
            if(empty($actions[$i]))
            {
                $etats[] = null;
                $heures = 0;
                $bareme = null;
            }
            else {
                $heures = $services['dao.action']->getDiffTimeByDay($actions[$i]);
                $bareme = $services['dao.bareme']->findOneById($action->id_bareme);
                $etats[] = $services['dao.etat']->findOneById($bareme->id_etat);
            }
            $appareil = $services['dao.appareil']->findOneById($homepieces[$i]->id_app);
            $appareils[] = $appareil;
            if($bareme != null){
                $consoAppareils[] += ($heures['veille'] * $appareil->conso_instant)*0.05 / 1000;
                $consoAppareils[$i] += $heures['on'] * $appareil->conso_instant / 1000;
                $consoPiece += ($heures['veille'] * $appareil->conso_instant)*0.05 / 1000;
                $consoPiece += ($heures['on'] * $appareil->conso_instant) / 1000;
            }else{
                $consoAppareils[] = 0;
                $consoPiece += 0;
            }
        }

        $pieces = $services['dao.piece']->getAll();
        $iconesPieces = [];

        for($i = 0; $i < sizeof($pieces); $i++){
            $icone = $services['dao.icone']->findOneById($pieces[$i]['id_ico']);
            $iconesPieces[] = $icone->icone;
        }

        require '../views/piece.php';
        $view = ob_get_clean();
        return $view;
    }
    else
    {
        return $response->withRedirect('../login');
    }
});
