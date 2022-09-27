<?php function drawRegisterForm() { ?>
  
  <link rel="stylesheet" href="../css/logreg.css">
  
  <div class="container" id="container">
    <div class="form-container sign-up-container">
    </div>
    <div class="form-container sign-in-container">
      <form form action="../actions/signupUser.php" method="post">
        <h1>Sign Up</h1>
        <div class="social-container">
        </div>
        <input type="username" name="username" placeholder="Username" />
        <input type="email" name="email" placeholder="Email" />
        <input type="name" name="name" placeholder="Name" />
        <input type="password" name="password" placeholder="Password" />
        <input type="usertype" name="userType" placeholder="User Type - insert <customer, owner or driver>" />
        <input type="phoneNumber" name="phoneNumber" placeholder="Phone Number" />
        <input type="address" name="address" placeholder="Address" />
        <button type="submit">Create Account</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
        </div>
        <div class="overlay-panel overlay-right">
      
      <p>Already have an account? Try logging in!</p>
      <a href="login.php"><button class ="ghost" id="signUp">Sign in</button>
     
          </div> 
        </div>
      </div>
    </div>
  </div>
  
  <?php } ?>
 