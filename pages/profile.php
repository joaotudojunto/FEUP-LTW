<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../classes/User.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/profile.tpl.php');
  require_once('../templates/frontpage.tpl.php');


  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getUsername());

  drawHeaderProfile($session);
  drawFrontPage(); 
  drawFooter();
?>
