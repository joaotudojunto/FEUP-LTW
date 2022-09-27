<?php
  declare(strict_types = 1);

  session_start();

  require_once('../templates/restaurants.tpl.php');
  require_once('../classes/Restaurant.php');
  require_once('../templates/main.tpl.php');
  require_once('../database/connection.php');
  require_once('../classes/Category.php');
  require_once('../templates/profile.tpl.php');
  require_once('../utils/session.php');

  $db = getDatabaseConnection();
  $restaurants = Restaurant::getRestaurants($db,20);
  $descriptions = Category::getCategories($db);
  //$pics = getPictures();


  $session = new Session();

  drawHeaderProfile($session);
  drawMainPage($restaurants,$db,$descriptions);
  drawFooter();
 

?>