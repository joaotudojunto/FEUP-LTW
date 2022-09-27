<?php
    declare(strict_types = 1);

    require_once('../../utils/session.php');
    $session = new Session();

    require_once('../../database/connection.php');
    require_once('../../classes/User.php');
    require_once('../../classes/FavoriteRestaurant.php');
    require_once('../../classes/Restaurant.php');

    $db = getsubActionDatabaseConnection();

    $username = $session->getUsername();
    $name = $_GET['name'];
    $restaurant = Restaurant::getRestaurantByName($db, $name);
    $user = User::getUser($db, $username);

    if ($session->isLoggedIn()){
        FavoriteRestaurant::addFavoriteRestaurant($db, $restaurant, $user);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    die();
?>