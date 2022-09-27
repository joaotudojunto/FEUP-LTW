
<?php function drawAbout() {?>

<link rel="stylesheet" href="../css/about.css">
<head>
  <div class="about-section">
    <h1>Welcome to our contacts page!</h1>
    <p>We are 3 professional web designers, below you can find information on how to contact us</p>
  </div>
</head>
  
  <h1 style="text-align:center">Our Team</h1>

<body>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="../images/joao.jpg" alt="Joao" style="width:60%"></br>
      <div class="container">
        <h2>João Duarte</h2>
        <p class="title">Junior Frontend Developer</p>
        <p>Mastermind behind this awesome work</p>
        <p><button class="button">E-mail contact: CEO@gmail.com </button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="../images/miguel.png" alt="Miguel" style="width:80%"></br>
      <div class="container">
        <h2>Miguel Tavares</h2>
        <p class="title">Junior Frontend Developer</p>
        <p>He first said: 'dont give up on your dreams', and then went to sleep.</p>
        <p><button class="button">E-mail contact: miguelanime@gmail.com</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
        <div class="img">
      <img src="../images/alberto.jpg" alt="Alberto" style="width:80%">
    </div></br>
      <div class="container">
        <h2>Alberto Serra</h2>
        <p class="title">Junior Frontend Developer</p>
        <p>No, i cannot hack your social media account.</p>
        <p><button class="button">E-mail contact: berto@chad.com</button></p>
      </div>
    </div>
  </div>
</div>

</body>

<?php } ?>