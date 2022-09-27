<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/FavoriteRestaurant.php');
    require_once(__DIR__ . '/../classes/Restaurant.php');

    $db = getDatabaseConnection();

    $username = $session->getUsername();
    $restaurant = Restaurant::getRestaurantByName($db, $_GET['name']);
    $user = User::getUser($db, $username);

    if ($session->isLoggedIn()){
        FavoriteRestaurant::removeFavoriteRestaurant($db, $restaurant, $user);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    die();
?>