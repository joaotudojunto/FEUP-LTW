<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/FoodOrder.php');
    require_once(__DIR__ . '/../classes/Restaurant.php');

    $db = getDatabaseConnection();

    $username = $session->getUsername();
    $restaurant = Restaurant::getRestaurantByName($db, $_GET['name']);
    $owner = $restaurant->getUser();

    if ($session->isLoggedIn()){
        $idFoodOrder = FoodOrder::addFoodOrder($db, $_POST['content'], $username, $restaurant->getIdRestaurant());
        Notification::addNotification($db, $username, "NewFoodOrder", "Food order requested by the user.");
        Notification::addNotification($db, $owner->getUsername(), "NewFoodOrder", "New Food order to the restaurant.");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    die();
?>