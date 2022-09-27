<?php require_once('../utils/session.php');
      require_once('../classes/Restaurant.php');

?>


<?php function drawUserProfile(PDO $db,User $user,array $faves) {?>
    <link rel="stylesheet" href="../css/userprofile.css">
    <div class="profile">
            <div class="pfp-container">
            <img src="../images/solaire.jpg" alt=""/>
                <div class="overlay">
                <a href="/restaurantpage.php"><div class ="text">Change Picture</div></a>
                </div>
            </div>
            <div class="profile-name">
                <div class="profile-text">
                            <h5>
                                <?= $user->getUsername() ?>
                            </h5>
                </div>
            </div>
            <div class="idButton">
                <input type="submit" class="profile-edit" name="btnAddMore" value="Edit Profile" onclick="location.href='../pages/editprofile.php';">

            </div>
            <div class="info-container">
                                <div class="row">
                                    <div class="info">
                                        <label>User Id</label>
                                    </div>
                                    <div class="info">
                                        <p><?= $user->getUsername() ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="info">
                                        <label>Name</label>
                                    </div>
                                    <div class="info">
                                        <p><?= $user->getName() ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="info">
                                        <label>Address</label>
                                    </div>
                                    <div class="info">
                                        <p><?= $user->getAddress() ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="info">
                                        <label>Phone</label>
                                    </div>
                                    <div class="info">
                                        <p><?= $user->getPhoneNumber() ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="info">
                                        <label>User Type</label>
                                    </div>
                                    <div class="info">
                                        <p><?= $user->getUserType() ?></p>
                                    </div>
                                </div>
                </div>

                <div class="info-container">
                                <div class="row">
                                    <div class="favorite">
                                        <label><?= $user->getName() ?>'s Favorite Restaurants</label></br>
                                        <?php foreach($faves as $idFav){ ?>
                                            <p><?= Restaurant::getRestaurantNameById($db,$idFav)?></p>
                                        <?php } ?>
                                    </div>
                                    
                </div>
            </div>
        </div>         
</div>
<?php } ?>