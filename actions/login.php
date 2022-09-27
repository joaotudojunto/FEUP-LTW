<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');

  $session = new Session();

  require_once('../database/connection.php');
  require_once('../classes/User.php');

  $db = getDatabaseConnection();
  $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);

  if ($user) {
    $session->setUsername($user->getUsername());
    $session->setName($user->getName());
    $session->addMessage('Success', 'The login was successful!');
  }else {
    $session->addMessage('Error', 'The password is wrong!');
  }

  header('Location: ' . '../index.php');
  
?>