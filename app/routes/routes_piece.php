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
        for($i = 0; $i < sizeof($homepieces); $i++)
        {
            $actions[] = $services['dao.action']->findLastActions($homepieces[$i]->id);
            if(empty($actions[$i]))
            {
                $etats[] = null;
            }
            else {
                $heure = $services['dao.action']->getDiffTime($actions[$i]);
                $bareme = $services['dao.bareme']->findOneById($actions[$i][0]['id_bareme']);
                $etats[] = $services['dao.etat']->findOneById($bareme->id_etat);
            }

            $appareils[] = $services['dao.appareil']->findOneById($homepieces[$i]->id_app);
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