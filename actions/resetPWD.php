<?php

    declare(strict_types = 1);

    require_once('../utils/session.php');
    $session = new Session();

    require_once('../database/connection.php');
    require_once('../classes/User.php');

    $db = getDatabaseConnection();

    $username = $session->getUsername();
    $user = User::getUser($db,$username);

    if ($session->isLoggedIn()){
        try{
            $user->resetUserPWD($db,$_POST['password']);
            header('Location: ../User/'.$_SESSION['username']);
            exit();
        } catch(Exception $e) {
            header('Location: ../User/'.$_SESSION['username']);
        }   
    } 

    header('Location: ../main.php');
?>
