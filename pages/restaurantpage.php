<?php
    //require_once('templates/restaurantpage.tpl.php');
    require_once('../templates/common.tpl.php');
    require_once('../templates/restaurantpage.tpl.php');
    require_once('../database/connection.php');
    require_once('../classes/Restaurant.php');
    require_once('../classes/Image.php');
    require_once('../templates/main.tpl.php');
    require_once('../templates/profile.tpl.php');

    $id = $_GET['id'];

    $db = getDatabaseConnection();
    $restaurants = Restaurant::getRestaurants($db,20);
    $restaurant = Restaurant::getRestaurant($db,$id);

    $menuDishes = Menu::getMenuDish($db,$restaurant->getMenu()->getIdMenu());
    $reviews = Review::getRestReview($db,$restaurant->getMenu()->getIdMenu());

    //$imgpath = Image::getImageByRestaurant($db,$restaurant->getIdRestaurant())->getTitle();

    require_once('../utils/session.php');

    $session = new Session();

    drawHeaderProfile($session);
    drawRestaurantPage($restaurant,$db,$menuDishes,$reviews,$session);
    drawFooter();
?>