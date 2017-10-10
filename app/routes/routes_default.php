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

				$actions = $services['dao.action']->findAllByUser($_SESSION['user']);
				$_SESSION['userPoints'] = $services['dao.bareme']->getSumPointByUser($actions);

				$usersFamily = $services['dao.users']->findAllByFamily($_SESSION['famille']);
				$arrayBestHunters = $services['dao.family']->getBestHunter($usersFamily);
				$bestHunter = $services['dao.users']->findOneById($arrayBestHunters[0]);

                $pieces = $services['dao.piece']->getAll();
                $consoPieces = [];
                $iconesPieces = [];

                for($i = 0; $i < sizeof($pieces); $i++){
                    $piece = $services['dao.piece']->findOneById($pieces[$i]['id']);
                    $homepieces2 = $services['dao.homepiece']->findAllByHomePiece($home->id, $piece->id);
                    $icone = $services['dao.icone']->findOneById($piece->id_ico);
                    $iconesPieces[] = $icone->icone;

                    $actions2 = [];
                    $consoPiece = 0;

                    for($j = 0; $j < sizeof($homepieces2); $j++)
                    {
                        if($homepieces2[$j]->id != null){
                            $actions2[] = $services['dao.action']->findLastActions($homepieces2[$j]->id);

                            if(empty($actions2[$j]))
                            {
                                $heures = 0;
                                $bareme = null;
                            }
                            else {
                                $heures = $services['dao.action']->getDiffTime($actions2[$j]);
                                $bareme = $services['dao.bareme']->findOneById($actions2[$j][0]['id_bareme']);
                            }
                            
                            $appareil = $services['dao.appareil']->findOneById($homepieces2[$j]->id_app);
                            if($bareme != null){
                                if($bareme->id == 4){
                                    $consoAppareils[] = ($heures * $appareil->conso_instant)*0.05;
                                    $consoPiece += ($heures * $appareil->conso_instant)*0.05;
                                }else{
                                    $consoAppareils[] = $heures * $appareil->conso_instant;
                                    $consoPiece += ($heures * $appareil->conso_instant);
                                
                                }
                            }else
                            {
                                $consoAppareils[] = 0;
                                $consoPiece += 0;
                            }
                            
                            
                        }

                    }
                    $consoPieces[] = $consoPiece;
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
                        $bareme = null;
                    }
                    else {
                        $heures = $services['dao.action']->getDiffTime($actions[$i]);
                        $bareme = $services['dao.bareme']->findOneById($actions[$i][0]['id_bareme']);
                    }
                    $appareil = $services['dao.appareil']->findOneById($homepieces[$i]->id_app);
                    if($bareme != null){
                        if($bareme->id == 4){
                            $consoTotale += ($heures * $appareil->conso_instant)*0.05;
                        }else{
                            $consoTotale += ($heures * $appareil->conso_instant);
                        }
                    }else{
                        $consoTotale += 0;
                    }
                    
                }

                require '../views/index.php';
                $view = ob_get_clean();
                return $view;
            }else{
                return $response->withRedirect('login');
            }

	});
