<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../classes/User.php');
  require_once('../classes/Review.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getUsername());

  if(isset($_POST['username']) && $_POST['username'] != ""){
    User::editUsername($db, $user->getUsername(),$_POST['username']);
    if(strcmp($user->getUserType(),"owner") == 0){
      Restaurant::setUserID($db,$user->getUsername(),$_POST['username']);
    } 
    Review::setUserID($db,$user->getUsername(),$_POST['username']);
    $session->setUsername($_POST['username']);
  }
  if(isset($_POST['name']) && $_POST['name'] != ""){
    User::editName($db, $user->getName(),$_POST['name']);
  }
  if(isset($_POST['password']) && $_POST['password'] != ""){
    User::editPassword($db, $user->getPassword(),$_POST['password']);
  }
  if(isset($_POST['address']) && $_POST['address'] != ""){
    User::editAddress($db, $user->getAddress(),$_POST['address']);
  
  }
  if(isset($_POST['userType']) && $_POST['userType'] != ""){
    User::editUserType($db, $user->getUserType(),$_POST['userType']);
  }
  if(isset($_POST['phoneNumber']) && $_POST['phoneNumber'] != ""){
    User::editPhoneNumber($db, $user->getPhoneNumber(),$_POST['phoneNumber']);
  }

  header('Location: ../pages/userprofile.php');

?>