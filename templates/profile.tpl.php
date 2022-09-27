<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeaderProfile(session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Food To go</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    
  </head>
    <body>
    <header>
      
      <div class="header">
        
      <a href="/index.php" class="logo">Food To Go</a>
      <img src="../images/logo.png">
      <div class="header-right">
        <?php 
          if ($session->isLoggedIn()) drawDropDown();
          else drawNoSession();
        ?>
        
      </div>
      
    </div>
    

</form>
      
    </header>
<?php } ?>

<?php function drawDropDown() { ?>
  <div class="dropdown">
                <button  class="dropbtn">Profile</button>
                <div class="dropdown-content">
                    <a href="../pages/userprofile.php">Profile</a>
                    <a href="../pages/cart.php">Shopping Cart</a>
                    <a href="../actions/logout.php">Logout</a>
                </div>
  <?php } ?>

<?php function drawNoSession() { ?>
  <a href="../pages/login.php">Login</a>
  <a href="../pages/register.php">Register</a>
  <a href="../pages/cart.php">Shopping Cart</a>
<?php } ?>

