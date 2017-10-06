<?php

$app->get('/lib/css/{nomFichier}', function($request, $response, $args){
  ob_start();
  require 'lib/css/'.$args['nomFichier'];
  $view = ob_get_clean();
  return $view;
});

$app->get('/lib/js/{nomFichier}', function($request, $response, $args){
  ob_start();
  require 'lib/js/'.$args['nomFichier'];
  $view = ob_get_clean();
  return $view;
});

$app->get('/lib/img/{nomFichier}', function($request, $response, $args){
  ob_start();
  require 'lib/img/'.$args['nomFichier'];
  $view = ob_get_clean();
  return $view;
});
