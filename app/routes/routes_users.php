<?php

/**
 * road to login
 */
$app->get('/login', function ($request, $response, $args) use($app) {
    //if someone is connected -> redirect to home page
    if(isset($_SESSION['is_user'])){
        return $response->withRedirect('.');
    }else{
        //Display login page
        ob_start();
        $deco = false;
        require '../views/users/login.php';
        $view = ob_get_clean();
        return $view;
    }
});

/**
 * road when user try to connect
 */
$app->post('/connection', function ($request, $response, $args) use($app, $services) {
    $deco = false;
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    //connection to the user
    $user = $services['dao.users']->exists($mail, $password);

    //if user is existing -> connection and redirect to home page
    if(!is_null($user))
    {
        //creation of session
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

/**
 * road to disconnect
 */
$app->get('/deconnexion', function ($request, $response, $args) use($app, $services) {
    //destroy the session
    ob_start();
    session_destroy();
    $deco = true;
    // display the login page
    require '../views/users/login.php';
    $view = ob_get_clean();
    return $view;
});
