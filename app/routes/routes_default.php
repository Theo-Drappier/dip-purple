<?php

	/**
	 * It's the default road, which is use, it will redirect to the page index.php
	 */
	$app->get('/', function ($request, $response, $args) use ($services){
            //if user is connected -> display home page else redirect login page
            if($_SESSION['is_user']){
                ob_start();

                $_SESSION['famille'] = $services['dao.family']->findOneById($_SESSION['user']->id);
                $home = $services['dao.home']->findOneByIdFamily($_SESSION['famille']->id);
                
                $pieces = $services['dao.piece']->getAll();
                $consoPieces = [];
                
                for($i = 0; $i < sizeof($pieces); $i++){
                    $piece = $services['dao.piece']->findOneById($pieces[$i]['id']);
                    $homepieces2 = $services['dao.homepiece']->findAllByHomePiece($home->id, $piece->id);
                    
                    $actions2 = [];
                    $consoPiece = 0;
                    
                    for($j = 0; $j < sizeof($homepieces2); $j++)
                    {
                        if($homepieces2[$j]->id != null){
                            $actions2[] = $services['dao.action']->findLastActions($homepieces2[$j]->id);
                            
                            if(empty($actions2[$j]))
                            {
                                $heures = 0;
                            }
                            else {
                                $heures = $services['dao.action']->getDiffTime($actions2[$j]);
                            }
                            $appareil = $services['dao.appareil']->findOneById($homepieces2[$j]->id_app);
                            $consoAppareils[] = $heures * $appareil->conso_instant;
                            $consoPiece += ($heures * $appareil->conso_instant);
                        }
                       
                    }
                    $consoPieces[] = $consoPiece;
                    //var_dump($pieces);
                }
                
                $homepieces = $services['dao.homepiece']->findAllByHome($home->id);
                $actions = [];
                $consoTotale = 0;

                for($i = 0; $i < sizeof($homepieces); $i++)
                {
                    $actions[] = $services['dao.action']->findLastActions($homepieces[$i]->id);
                    if(empty($actions[$i]))
                    {
                        $heures = 0;
                    }
                    else {
                        $heures = $services['dao.action']->getDiffTime($actions[$i]);
                    }
                    $appareil = $services['dao.appareil']->findOneById($homepieces[$i]->id_app);
                    $consoTotale += ($heures * $appareil->conso_instant);
                }
                
                require '../views/index.php';
                $view = ob_get_clean();
                return $view;
            }else{
                return $response->withRedirect('login');
            }

	});
