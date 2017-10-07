<?php

use RedBeanPHP\R;

R::setup('mysql:host=localhost;dbname=dip-purple_v0',
         'root', 'pwsio');

//$services['dao.fields'] = \DIP\dao\FieldsDAO::getInstances();
$services['dao.abonnement'] = \DIP\dao\AbonnementDAO::getInstances();
$services['dao.action'] = \DIP\dao\ActionDAO::getInstances();
  
