<?php

require_once __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/config/dev.php';
$app = new \Slim\App($configuration);
$services = [];
require __DIR__.'/../app/app.php';
require __DIR__.'/../app/routes/routes_default.php';
require __DIR__.'/../app/routes/routes_lib.php';

$app->run();
