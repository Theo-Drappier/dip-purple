<?php

$app->get('/appareil/{id}', function ($request, $response, $args) use ($services){
        //if user is connected -> display home page else redirect login page
        if($_SESSION['is_user']){
            ob_start();
            $id = $args['id'];
            $actions = $services["dao.action"]->findLastActions($id);
			$action = $actions[0];
            $homepiece = $services["dao.homepiece"]->findOneById($id);
            $piece = $services["dao.piece"]->findOneById($homepiece->id_piece);
            $appareil = $services["dao.appareil"]->findOneById($homepiece->id_app);

            if($action != null){
				$heures = $services['dao.action']->getDiffTime($actions);
				$consoAppareil = ($heures * $appareil->conso_instant) / 1000;
                $bareme= $services["dao.bareme"]->findOneById($action['id_bareme']);
            }else{
				$consoAppareil = 0;
                $bareme = $services["dao.bareme"]->findOneById(5);
            }


            $icone= $services["dao.icone"]->findOneById($appareil->id_ico);

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
			$services["dao.action"]->insert($action);
		}
	}
	else {
		if($_POST['statuApp'] == 3)
		{
			$services["dao.action"]->insert($action);
		}
	}
    return $response->withRedirect('../piece/'.$_POST["id_piece"]);
});
