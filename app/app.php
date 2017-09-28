<?php

use RedBeanPHP\R;

R::setup('mysql:host=localhost;dbname=hackathyon_test',
         'YOUR_USERNAME', 'YOUR_PASSWORD');

$services['dao.fields'] = \DIP\dao\FieldsDAO::getInstances();
