<?php

$app->get('/appareil/{id}', function ($request, $response, $args) use ($services){
        //if user is connected -> display home page else redirect login page
        if($_SESSION['is_user']){
            ob_start();
            $id = $args['id'];
            $action = $services["dao.action"]->findLastAction($id);
            $actionsDay = $services['dao.action']->findAllByToday($id);

            $consoAppareil = 0;

            $homepiece = $services["dao.homepiece"]->findOneById($id);
            $piece = $services["dao.piece"]->findOneById($homepiece->id_piece);
            $appareil = $services["dao.appareil"]->findOneById($homepiece->id_app);
            $icone= $services["dao.icone"]->findOneById($appareil->id_ico);

            if(!empty($actionsDay)){
    			$heures = $services['dao.action']->getDiffTimeByDay($actionsDay);
    			$consoAppareil += ($heures['on'] * $appareil->conso_instant) / 1000;
                $consoAppareil += ($heures['veille'] * $appareil->conso_instant * 0.05) / 1000;
                $bareme= $services["dao.bareme"]->findOneById($action['id_bareme']);
            }else{
    			$consoAppareil = 0;
                $bareme = $services["dao.bareme"]->findOneById(5);
            }

            $pieces = $services['dao.piece']->getAll();
            $iconesPieces = [];

            for($i = 0; $i < sizeof($pieces); $i++){
                $icone1 = $services['dao.icone']->findOneById($pieces[$i]['id_ico']);
                $iconesPieces[] = $icone1->icone;
            }

            require '../views/appareil.php';
            $view = ob_get_clean();
            return $view;
        }else{
            return $response->withRedirect('login');
        }

});
$app->post('/appareil/insert', function($request, $response, $args) use($services)
{
    $action=[];
    $action["statuApp"]=$_POST["statuApp"];
    $action["user"]=$_SESSION["user"];
    $action["id_hp"]=$_POST["id_hp"];
	$lastAction = $services["dao.action"]->findLastAction($_POST['id_hp']);

    if(!is_null($lastAction))
	{
		if($lastAction->id_bareme != $_POST['statuApp'])
		{
            if($_POST['statuApp'] == 4)
            {
                if($lastAction->id_bareme != 5)
                {
                    $services["dao.action"]->insert($action);
                }
            }
            else {
                $services["dao.action"]->insert($action);
            }
		}
	}
	else {
		if($_POST['statuApp'] == 3)
		{
			$services["dao.action"]->insert($action);
		}
	}


	$actions = $services['dao.action']->findAllByUser($_SESSION['user']);
	$_SESSION['userPoints'] = $services['dao.bareme']->getSumPointByUser($actions);
    return $response->withRedirect('../piece/'.$_POST["id_piece"]);
});
