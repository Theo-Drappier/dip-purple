<?php

$app->get('/login', function () use($app) {
    ob_start();
    require '../views/users/login.php';
    $view = ob_get_clean();
    return $view;
});

$app->post('/connection', function ($request, $response, $args) use($app, $services) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $user = $services['dao.users']->exists($mail, $password);
    var_dump($user);
    if(!is_null($user))
    {
        $_SESSION['user'] = $user;
        $_SESSION['is_user'] = true;
        return $response->withRedirect('.');
    }
    ob_start();
    $_SESSION['error'] = 500;
    require '../views/users/login.php';
    $view = ob_get_clean();
    return $view;
});
