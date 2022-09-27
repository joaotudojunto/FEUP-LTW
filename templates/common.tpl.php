<?php declare(strict_types = 1); ?>

<?php function drawSearchButton() { ?>
    <link rel="stylesheet" href="../css/search.css">

    <div class="SearchBarButton">
    <form onsubmit="event.preventDefault();" role="search">
    <input id="Search" type="search" placeholder="Search..." autofocus required />
    <button type="submit"><i class="fa fa-search"></i></button>
    </div>
        
  <?php } ?>

<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Food To go</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    
  </head>
    <body>
    <header>
      <div class="header">
      <a href="../index.php" class="logo">Food To Go</a>
      <img src="../images/logo.png">
      <div class="header-right">
          <a href="../pages/login.php">Login</a>
          <a href="../pages/register.php">Register</a>
          <a href="../pages/cart.php">Shopping Cart</a>
    </div>
   
</form>
    
    </header>
<?php } ?>

<?php function drawBody(){ ?>
  <ul>
    <li>Name</li>
    <li>Location</li>
    <li>Category</li>
    <li>Classication</li>
    <li>Price Range</li>
  </ul>
  <ul>
    <li><a href = "restaurant.php"> Mcdonald's </a></li>
    <li><a href = "restaurant.php">KFC </a></li>
    <li><a href = "restaurant.php">Burger King</a></li>
  </ul>

<?php } ?>



  <?php function drawFooter() { ?>

    <link rel="stylesheet" href="../css/footer.css">

    <footer>
    <div class="seal">
          <img src="../images/approve.png"> 
      </div>
        <div class="app">
          <h4>Download app for Android or IOS</h4>
            <img src="../images/appstore.png"> 
      </div>
            <div class="row">
            <ul style="padding-top: 30px;">
  	 				  <li><a href= "../pages/about.php"><h3>Contacts</h3></a></li>
  	 				  <li><a href= "../pages/faq.php"><h3>FAQ's</h3></a></li>
  	 			</ul>
      </div>
</footer>  
 

  <?php } ?>

