<?php

require_once ('User.php');
require_once ('Restaurant.php');

class FavoriteRestaurant{

    private User $user;
    private Restaurant $restaurant;

    public function __construct(
        User $user,
        Restaurant $restaurant 
    ){
        $this->user = $user;
        $this->restaurant = $restaurant;
    }

    public function getUser() : User { return $this->user;}
    public function getRestaurant() : Restaurant { return $this->restaurant;}
    
    public function setUser(User $user) : void { 
        $this->user= $user; 
    }

    public function setRestaurant(Restaurant $restaurant) : void {
        $this->restaurant = $restaurant;
    }

    static function addFavoriteRestaurant(PDO $db, Restaurant $restaurant, User $user) : void {
        $stmt = $db->prepare('INSERT INTO FavoriteRestaurant (restaurant, user)
                              VALUES (:restaurant, :user)');
        $stmt->bindValue(':restaurant', $restaurant->getIdRestaurant(), PDO::PARAM_INT);
        $stmt->bindValue(':user', $user->getUsername(), PDO::PARAM_STR);
        $stmt->execute();
    }

    static function removeFavoriteRestaurant(PDO $db, Restaurant $restaurant, User $user) : void {
        $stmt = $db->prepare('DELETE FROM FavoriteRestaurant
                              WHERE user = :user AND restaurant = :restaurant');
        $stmt->bindValue(':restaurant', $restaurant->getIdRestaurant(), PDO::PARAM_INT);
        $stmt->bindValue(':user', $user->getUsername(), PDO::PARAM_STR);
        $stmt->execute();
    }

    static function getFavoriteRestaurants(PDO $db, User $user) : array {
        $stmt = $db->prepare('SELECT restaurant FROM FavoriteRestaurant
                              WHERE user = :user');
        $stmt->bindValue(':user', $user->getUsername(), PDO::PARAM_STR);
        $stmt->execute();
        $rests = array();
        while($fav = $stmt->fetch()){
            $rests[] = $fav['restaurant'];
        }
        return $rests;
    }
}

?>