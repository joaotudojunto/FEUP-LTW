<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/FoodOrder.php');
    require_once(__DIR__ . '/../classes/FoodOrder.php');

    $db = getDatabaseConnection();

    $username = $session->getUsername();
    $foodOrder = FoodOrder::getFoodOrder($db, $_GET['idFoodOrder']);
    $restaurant = $foodOrder->getRestaurant();
    $owner = $restaurant->getUser();


    if ($session->isLoggedIn()) {
        $foodOrder->cancelFoodOrder($db, User::getUser($db,$user), $foodOrder->getIdFoodOrder());
        Notification::addNotification($db, $username, "orderCancelled", "Order was cancelled by the user.");
        Notification::addNotification($db, $owner->getUsername(), "orderCancelled", "Remove cancelled order from restaurant.");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    die();

?>
    