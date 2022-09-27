
<?php function drawLoginForm() { ?>
  
<link rel="stylesheet" href="../css/logreg.css">

<html>
<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="../actions/login.php" method="post">
			<h1>Sign in</h1>
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hey there!</h1>
				<p>Before signing in, please tell us what type of user you are!</p>
        
      <fieldset data-role="controlgroup" >
    	<legend>Choose a type:</legend>
         	<input type="radio" name="radio-choice-1" id="radio-choice-1" value="choice-1" checked="checked" />
         	<label for="radio-choice-1">Customer</label>

         	<input type="radio" name="radio-choice-1" id="radio-choice-2" value="choice-2"  />
         	<label for="radio-choice-2">Owner</label>

         	<input type="radio" name="radio-choice-1" id="radio-choice-3" value="choice-3"  />
         	<label for="radio-choice-3">Driver</label>
    </fieldset>
    <p>Don't have an account yet?</p>
    <a href="register.php"><button class ="ghost" id="signUp">Register</button>
   
          </div>	
		</div>
	</div>
</div>
</div>
</html>

<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="../actions/logout.php" method="post" class="logout">
    <a href="/profile.php"><?=$session->getName()?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>