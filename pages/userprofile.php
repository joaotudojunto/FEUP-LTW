<?php
  declare(strict_types = 1);

  require_once( '../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../classes/FavoriteRestaurant.php');
  require_once('../classes/User.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/profile.tpl.php');
  require_once('../templates/userprofile.tpl.php');
  require_once('../templates/main.tpl.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getUsername());
  $faves = FavoriteRestaurant::getFavoriteRestaurants($db,$user);

  drawHeaderProfile($session);
  drawUserProfile($db,$user,$faves); 
  drawFooter();
?>
