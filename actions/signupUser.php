<?php

    declare(strict_types = 1);

    require_once('../utils/session.php');
    $session = new Session();

    require_once('../database/connection.php');
    require_once('../classes/User.php');

    $db = getDatabaseConnection();

    $user = new User(
        htmlspecialchars($_POST['username']), 
        htmlspecialchars($_POST['userType']), 
        htmlspecialchars($_POST['password']), 
        htmlspecialchars($_POST['name']), 
        htmlspecialchars($_POST['phoneNumber']),
        htmlspecialchars($_POST['address']),
        htmlspecialchars($_POST['email']),
        'No default description'
    );

    echo 'ola';

try { 
    $user-> addUser($db);
    $session->setUsername(htmlspecialchars($_POST['username']));
    header('Location: ' . '../index.php');
} catch(Exception $e) {
    header('Location: ' .'../index.php');
}

die();

?>