<?php

	/**
	 * It's the default road, which is use, it will redirect to the page index.php
	 */
	$app->get('/appareil/{id}', function ($request, $response, $args) use ($services){
            //if user is connected -> display home page else redirect login page
            if($_SESSION['is_user']){
                ob_start(); 
                $id = $args['id'];
                $action = $services["dao.action"]->findLastAction($id);
                $homepiece = $services["dao.homepiece"]->findOneById($id);
                $piece = $services["dao.piece"]->findOneById($homepiece->id_piece);
                $appareil = $services["dao.appareil"]->findOneById($homepiece->id_app);
                $bareme= $services["dao.bareme"]->findOneById($action->id_bareme);
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
            $services["dao.action"]->insert($action);
            return $response->withRedirect('/piece/'.$_POST["id_hp"]);
        });
