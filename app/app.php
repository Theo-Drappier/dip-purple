<?php

use RedBeanPHP\R;

R::setup('mysql:host=localhost;dbname=dip-purple_v0',
         'YOUR_USERNAME', 'YOUR_PASSWORD');

$services['dao.users'] = \DIP\dao\UsersDAO::getInstances();
$services['dao.appareil'] = \DIP\dao\AppareilDAO::getInstances();
$services['dao.etat'] = \DIP\dao\EtatDAO::getInstances();
$services['dao.family'] = \DIP\dao\FamilyDAO::getInstances();
$services['dao.heurepc'] = \DIP\dao\HeurepcDAO::getInstances();
$services['dao.home'] = \DIP\dao\HomeDAO::getInstances();
$services['dao.homepiece'] = \DIP\dao\HomePieceDAO::getInstances();
$services['dao.piece'] = \DIP\dao\PieceDAO::getInstances();
