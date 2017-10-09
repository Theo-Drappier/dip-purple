<?php

	/**
	 * It's the default road, which is use, it will redirect to the page index.php
	 */
	$app->get('/', function ($request, $response, $args) use ($services){
            //if user is connected -> display home page else redirect login page
            if($_SESSION['is_user']){
                ob_start(); 
                
                $_SESSION['famille'] = $services['dao.family']->findOneById($_SESSION['user']->id);
                
                require '../views/index.php';
                $view = ob_get_clean();
                return $view;
            }else{
                return $response->withRedirect('login');
            }
        
	});
