<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/Restaurant.php');

    $db = getDatabaseConnection();

    $username = $session->getUsername();
    $restaurant = Restaurant::getRestaurant($db, $_GET['idRestaurant']);
    $owner = $restaurant->getUser();

    if ($session->isLoggedIn()) {
        $owner -> removeOwnerRestaurant($db, $restaurant->getIdRestaurant());
        Notification::addNotification($db, $owner->getUsername(), "restaurantRemoved", "Your Restaurant was removed with success.");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    die();
?>