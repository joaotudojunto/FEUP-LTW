<?php

require_once '/classes/User.php';
require_once '/classes/Restaurant.php';

class FoodOrder{
    
    private int $idFoodOrder;
    private string $state;
    private string $content;
    private string $requestDate;
    private User $user;
    private Restaurant $restaurant;

    public function __construct(
        int $idFoodOrder,
        string $state,
        string $content,
        string $requestDate,
        User $user,
        Restaurant $restaurant
    ){
        $this->idFoodOrder = $idFoodOrder;
        $this->state = $state;
        $this->content = $content;
        $this->requestDate = $requestDate;
        $this->user = $user;
        $this->restaurant = $restaurant;
    }

    public function getIdFoodOrder() : ?int { return $this->idFoodOrder;}
    public function getState() : string { return $this->state;}
    public function getContent() : string { return $this->content;}
    public function getRequestedDate() : int { return $this->requestDate;}
    public function getUser() : User { return $this->user;}
    public function getRestaurant() : Restaurant { return $this->restaurant;}

    public function setIdFoodOrder(int $idFoodOrder) : void {
        $tempIdFoodOrder = filter_var($idFoodOrder, FILTER_SANITIZE_NUMBER_INT);
        $this->idFoodOrder = $tempIdFoodOrder;
    }

    public function setState(string $state) : void {
        $tempState = filter_var($state, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->type = $tempState; 
    }

    public function setContent(string $content) : void {
        $tempContent = filter_var($content, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->content = $tempContent; 
    }

    public function setRequestDate(string $requestDate) : void {
        $tempRequestDate = filter_var($requestDate, FILTER_SANITIZE_NUMBER_INT);
        $this->requestDate = $tempRequestDate; 
    }
    
    public function setUser(User $user) : void { 
        $this->user= $user; 
    }

    public function setRestaurant(Restaurant $restaurant) : void { 
        $this->restaurant = $restaurant; 
    }

    static function getFoodOrder(PDO $db, string $idFoodOrder) : FoodOrder {
        $stmt = $db->prepare('SELECT * 
                            FROM FoodOrder 
                            WHERE idFoodOrder = ?');
        $stmt->execute(array($idFoodOrder));
        $foodOrder = $stmt->fetch();
        return new FoodOrder(
            $foodOrder['idFoodOrder'],
            $foodOrder['state'],
            $foodOrder['content'],
            $foodOrder['requestDate'],
            $foodOrder['user'],
            $foodOrder['restaurant']
            );
    }

    public function userOrderedFood(PDO $db, string $username, int $idRestaurant) : bool {
        $user = User::getUser($db,$username);
        $foodOrders = $user->getUserFoodOrders($db);
        foreach ($foodOrders as $foodOrder) {
            if ($foodOrder->getRestaurant()->getIdRestaurant() == $idRestaurant) 
                return true;
        }   
        return false;
    }

    static function addFoodOrder(PDO $db, string $content, string $username, int $idRestaurant ) : void {
        $stmt = $db->prepare('INSERT INTO FoodOrder (content, user, restaurant)
                              VALUES (:content,:user, :restaurant)');
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':user', $username, PDO::PARAM_STR);
        $stmt->bindValue(':restaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getFoodOrderOutcome(PDO $db, string $username, string $idRestaurant) : string {
        $firstIndex = 0;
        $stmt = $db->prepare('SELECT state
                              FROM FoodOrder
                              WHERE user = :username AND restaurant = :restaurant
                              ORDER BY orderDate DESC');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':restaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
        $foodOrder = $stmt->fetchAll();
        return $foodOrder[$firstIndex]['state'];
    }

    public function updateFoodOrderState(PDO $db, int $idFoodOrder, string $state) : void {
        $stmt = $db->prepare('UPDATE FoodOrder
                              SET state = :state 
                              WHERE idFoodOrder = :idFoodOrder'); 
        $stmt->bindValue(':state', $state);
        $stmt->bindValue(':idFoodOrder', $idFoodOrder);
        $stmt->execute();
    }

    public function cancelFoodOrder(PDO $db, User $user, int $idFoodOrder) : void {
        $stmt = $db->prepare('DELETE FROM FoodOrder
                            WHERE user = :username AND idFoodOrder=:idFoodOrder');
        $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(':idFoodOrder', $idFoodOrder, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>