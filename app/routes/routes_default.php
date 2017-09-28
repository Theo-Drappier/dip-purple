<?php

	use RedBeanPHP\R;
	/**
	 * It's the default road, which is use, it will redirect to the page index.php
	 */
	$app->get('/', function () use ($services){
	    ob_start(); // start buffering HTML output

		$testDao = $services['dao.fields']->findAll();
		$testDao2 = $services['dao.fields']->getByName('Test');

		require '../views/index.php';
	    $view = ob_get_clean(); // assign HTML output to $view
		return $view;
	});
