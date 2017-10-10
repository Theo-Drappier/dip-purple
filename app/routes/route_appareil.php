<?php

$app->get('/appareil/{id}', function ($request, $response, $args) use ($services){
        //if user is connected -> display home page else redirect login page
        if($_SESSION['is_user']){
            ob_start();
            $id = $args['id'];
            $actions = $services["dao.action"]->findLastActions($id);

            $homepiece = $services["dao.homepiece"]->findOneById($id);
            $piece = $services["dao.piece"]->findOneById($homepiece->id_piece);
            $appareil = $services["dao.appareil"]->findOneById($homepiece->id_app);
            $icone= $services["dao.icone"]->findOneById($appareil->id_ico);

            if(!empty($actions)){
    			$action = $actions[0];
    			$heures = $services['dao.action']->getDiffTime($actions);
    			$consoAppareil = ($heures * $appareil->conso_instant) / 1000;
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
			$services["dao.action"]->insert($action);
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
