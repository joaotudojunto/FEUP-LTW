<?php function drawFrontPage() {?>


<link rel="stylesheet" href="css/nav.css"> 
<html>
<head>
<title>Main Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
</head>
<body>


<!-- header com imagem -->
<header class="imagem" id="home">
<div class="alinhaesq" style="padding:48px">
<span class="TextoGrande">Your favorite restaurant, at home.</span><br>
<span class="Textomedio">The best website to search for your favorite food</span>
<p><a href="../pages/main.php" class="linkimg">Learn more about all of our restaurants</a></p>
</div> 

</header>

<!-- secao about -->
<div class="container" style="padding:100px 50px" id="about">
<h3 class="containerCentro" style="font-size: 24px;">ABOUT OUR WEBSITE</h3>
<p class="containerCentro" style="margin-bottom: 30px;">Key features</p>
<div class="row-padding containerCentro">
<div class="box">
  <i class="fa fa-desktop sizeIcon"></i>
  <p class="textoContainer">Responsive Website</p>
  <p>Our website nicely displayed wether your're on a mobile phone, or a computer!</p>
</div>
<div class="box">
  <i class="fa fa-solid fa-user-secret sizeIcon"></i>
  <p class="textoContainer">Top Security</p>
  <p>We have the latest security technology on our website, your card information is safe!</p>
</div>
<div class="box">
  <i class="fa fa-solid fa-truck sizeIcon"></i>
  <p class="textoContainer">Lightning Delivery</p>
  <p>We aim to deliver your food the fastest way possible!</p>
</div>
<div class="box">
  <i class="fa fa-solid fa-code sizeIcon"></i>
  <p class="textoContainer">Friendly Support</p>
  <p>Our website developers are 24/7 available to help you with any concern, except when they are making more coffee.</p>
</div>
</div>
</div>

<!-- secao become a driver -->
<div class="containerDriver" style="padding: 70px 50px;" id="driver">
<h3 class="containerCentroDriver" style="font-size: 24px; margin-bottom: 20px;">HOW TO BECOME A DRIVER?</h3>
<p class="containerCentroDriver" style="margin-top: 20px; margin-bottom: 50px; font-size: 20px; ">How can i submit an application and what are the rules?</p>
<div class="containerCentroDriver">
<div class="box1">
  <p class="textoContainerDriver"></p>
  <p>In order to drive for us, first you must be 18+ years old, have a valid driver's licence and a valid ID card, if you meet these requirements please contact us with your curriculum!</p>
</div>
</div>
</div>

<?php }?>