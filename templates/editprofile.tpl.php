<?php function drawEditForm() { ?>
  
  <link rel="stylesheet" href="../css/edit.css">
  
  <div class="container" id="container">
    <div class="form-container">
      <form action="../actions/editProfile.php" method="post">
        <h1>Edit Profile</h1>
        <div class="social-container">
        </div>
        <input type="username" name="username" placeholder="Username" />
        <input type="name" name="name" placeholder="Name" />
        <input type="password" name="password" placeholder="Password" />
        <input type="usertype" name="userType" placeholder="User Type - insert <customer, owner or driver>" />
        <input type="phoneNumber" name="phoneNumber" placeholder="Phone Number" />
        <input type="address" name="address" placeholder="Address" />
        <button type="submit">Edit Profile</button>
      </form>
    </div>
    </div>
  </div>
  
<?php } ?>
 