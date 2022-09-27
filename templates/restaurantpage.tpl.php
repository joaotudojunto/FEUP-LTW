<?php require_once('../templates/common.tpl.php');
      require_once('../classes/Restaurant.php');
      require_once('../classes/Menu.php');
      require_once('../classes/Dish.php');
      require_once('../classes/Review.php');
      require_once('../utils/session.php');
 ?>

<?php function drawRestaurantPage(Restaurant $restaurant, PDO $db, array $menuDishes, array $reviews,Session $session) {?>
  <head>
  <link rel="stylesheet" href="../css/restaurantpage.css"> 
</head> 

  <div class="restaurantinfo">

  <h1>Restaurant Information</h1>

  <div class="containerSlideshow">
    <h3 class="containerCentroSlideshow" style="font-size: 24px; margin-bottom: 20px;"><?= $restaurant->getName() ?></h3>
        <div class ="image"><img src="<?=Image::getImageByRestaurant($db,$restaurant->getIdRestaurant())->getTitle()?>"></div>   
        </div>

  <?php 
    if ($session->isLoggedIn()) drawFavB($restaurant);
  ?>
   

<div class="containers">
  <div class="containerHoras">
    <h3 class="containerCentroHoras" style="font-size: 24px; margin-bottom: 20px;">Working Hours</h3>
          <p>Monday: <?= $restaurant->getServiceHours() ?></p>
          <p>Tuesday: <?= $restaurant->getServiceHours() ?></p>
          <p>Wednesday: <?= $restaurant->getServiceHours() ?></p>
          <p>Thursday: <?= $restaurant->getServiceHours() ?></p>
          <p>Friday: <?= $restaurant->getServiceHours() ?></p>
          <p>Saturday: <?= $restaurant->getServiceHours() ?></p>
          <p>Sunday: Closed</p>
    </div>

    
  <div class="containerMenu">
    <h3 class="containerCentroMenu" style="font-size: 24px; margin-bottom: 20px;">Our Menu</h3>
          <?php foreach($menuDishes as $dishId){ ?>
          <p><?= Dish::getDish($db,$dishId)->getName() ?>......................... <?= Dish::getDish($db,$dishId)->getPrice()?>€ <input type="button" class="buttonCart" value="Add To Cart"></p>
          <?php } ?>
    </div>
    
  <div class="containerLocation">
    <h3 class="containerCentroLocation" style="font-size: 24px; margin-bottom: 20px;">Our Location</h3>
          <p>Address: <?= $restaurant->getAddress() ?></p>          
    </div>
    
</div>


<h2> Reviews </h2>

<?php foreach($reviews as $review){ ?>

<figure class="reviews">
  <figcaption>
    <blockquote>
      <p><?= $review->getText() ?></p></br>
    </blockquote>
    <h4>Rating: <?= $review->getClassification() ?> stars</h4>
    <p>User: <?= $review->getUser()->getUsername() ?> </p>
  </figcaption>
</figure>
<?php } ?>



    
<?php }?>

<?php function drawFavB(Restaurant $restaurant) { ?>
  <div class="favoritebox">
    <i class="fa fa-solid fa-heart sizeIcon"></i>
    <button type="button" class="button" onclick="location.href='../actions/actionsUser/addFavoriteRestaurant.php?name=<?=$restaurant->getName()?>'">Add To Favorites  </button>
  </div>
  <?php }?>