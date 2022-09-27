
<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../classes/User.php');

  $db = getDatabaseConnection();

  $users = User::searchUsers($db, $_GET['search'], 8);

  echo json_encode($users);
?>