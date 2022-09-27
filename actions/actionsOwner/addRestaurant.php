<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/Restaurant.php');

    $db = getDatabaseConnection();

    $username = $session->getUsername();
    $user = User::getUser($db,$username);
    

if ($session->isLoggedIn() && ($user->getUserType() == "Owner")){
        $idCategory = Category::getCategoryIdByName($db, $_POST['name']);
        $menu = Menu::getMenuByCategory($db, $idCategory);
        $restaurant = new Restaurant(
            $_POST['idRestaurant'],
            $_POST['name'],
            $_POST['classification'],
            $_POST['address'],
            $_POST['description'],
            $_POST['serviceHours'],
            $_POST['maxPrice'],
            $_POST['minPrice'],
            $user,
            $menu
        );
        $restaurant->addRestaurant($db);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
die();
?>