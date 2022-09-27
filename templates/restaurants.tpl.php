<?php 
  declare(strict_types = 1); 

  require_once('../classes/Image.php');

  //require_once('templates/restaurants.tpl.php');
?>

<?php function drawRest(array $restaurants,PDO $db) { ?>
    <div class ="restaurant-card-grid">
    <?php foreach($restaurants as $restaurant) { ?> 
      <a href="../pages/restaurantpage.php?id=<?=$restaurant->getIdRestaurant()?>">
      <article class="restaurant-card">
      <input type="hidden" class="attrib" name="name" value="<?=$restaurant->getName()?>">  
      <input type="hidden" class="attrib" name="location" value="<?=$restaurant->getAddress()?>">
      <input type="hidden" class="attrib" name="foodstyle" value="<?=$restaurant->getDescription()?>">
      <input type="hidden" class="attrib" name="rating" value="<?=$restaurant->getClassification()?>">

        <img src="<?=Image::getImageByRestaurant($db,$restaurant->getIdRestaurant())->getTitle()?>">
        <div class="restaurant-card-content" >
          <div class ="text"><?=$restaurant->getDescription()?></div>
        </div>
        <h2><?=$restaurant->getName()?></h2>
      </article>
    </a>
    <?php } ?>
    </div>
<?php } ?>

<?php function printScore(array $restaurant) { ?>
  <section id="restaurants">
    <?php foreach($restaurant as $restaurants) { ?> 
      <article>
        <a href="restaurant.php?id=<?=$restaurant->classification?>"><?=$restaurant->name?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function detalhes(array $restaurant) { ?>
  <section id="restaurants">
    <?php foreach($restaurant as $restaurants) { ?> 
      <p>
        <a href="restaurant.php?id=<?=$restaurant->description?>"><?=$restaurant->name?></a>
      </p>
    <?php } ?>
  </section>
<?php } ?>

<?php function printComments(array $restaurant){?>
  <?php foreach($restaurant as $restaurants){ ?>
    <p>Boa ementa</p>
    <p>Espetaculo</p>
    <p>Mau serviço</p>
  <?php } ?>
<?php } ?>

<?php /* function drawArtist(Artist $artist, array $albums) { ?>
  <h2><?=$artist->name?></h2>
  <section id="albums">
    <?php foreach ($albums as $album) { ?>
    <article>
      <img src="https://picsum.photos/200?<?=$album->id?>">
      <a href="album.php?id=<?=$album->id?>"><?=$album->title?></a>
      <p class="info"><?=$album->tracks?> tracks / <?=$album->length?> min</p>
    </article>
    <?php } ?>
  </section>
<?php }  */ ?>

