<?php

require_once '/classes/Dish.php';
require_once '/classes/User.php';

class FavoriteDish{

    private Dish $dish;
    private User $user;

    public function __construct(
        Dish $dish,
        User $user
    ){
        $this->dish = $dish;
        $this->user = $user;
    }

    public function getDish() : Dish { return $this->restaurant;}
    public function getUser() : User { return $this->user;}

    public function setDish(Dish $dish) : void { 
        $this->dish = $dish; 
    }
    
    public function setUser(User $user) : void { 
        $this->user= $user; 
    }
}

?>