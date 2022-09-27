<?php require_once('../templates/common.tpl.php');
require_once ('../classes/Restaurant.php');
require_once ('../templates/restaurants.tpl.php');
?>



<?php function drawMainPage(array $restaurants,PDO $db,array $descriptions) {?>

  <link rel="stylesheet" href="../css/style.css"> 


<main>

    <h1 class="default-title">The best restaurants near you</h1>

    <article id="main-page">
    <article id="filter">
        <h2>Filter by</h2>
        <section id="filter-search" class="body">
            <label class ="Name"><h2>Name</h2> <input type="text" id="name" placeholder="Search by name..." title="Restaurant's name"></label>
            <label class ="Location"><h2>Location</h2> <input type="text" id="location" placeholder="Search by Location..." title="Restaurant location"></label>
            <label class ="Food Style"><h2>Food Style</h2> <input type="text" id="foodstyle" placeholder="Search by style..." title="Restaurant rating"></label>
           
                <h3>Rating </h3>
                <section id="check-area">
                    <?php for($i = 1; $i <= 5; $i++){ ?>
                    <label class="container"><input type="checkbox" id="c<?=$i?>" name="checkbox" value=" <?=$i?>"> <?=$i?></label>
                    <?php } ?>
                </section>
    </article>
        
    <section id="restaurant-list">
        <?php drawRest($restaurants,$db); ?>
    </section>
</article>    

<script> <?php require_once("../script/script.js") ?></script>
               
</main>


<?php }?>
