<?php

require_once ('User.php');
require_once ('Menu.php');

define('RESTS_IMAGES_DIR', __DIR__ .'pngs\Restaurants');

class Restaurant{

    private int $idRestaurant;
    private string $name;
    private int $classification;
    private string $address;
    private string $description;
    private string $serviceHours;
    private int $maxPrice;
    private int $minPrice;
    private User $user;
    private Menu $menu;
    
    public function __construct(
    int $idRestaurant,
    string $name,
    int $classification,
    string $address,
    string $description,
    string $serviceHours,
    int $maxPrice,
    int $minPrice,
    User $user,
    Menu $menu){

        $this->idRestaurant = $idRestaurant;
        $this->name = $name;
        $this->classification = $classification;
        $this->address = $address;
        $this->description = $description;
        $this->serviceHours = $serviceHours;
        $this->maxPrice = $maxPrice;
        $this->minPrice = $minPrice;
        $this->user = $user;
        $this->menu = $menu;
    }

    public function getIdRestaurant() : int { return $this->idRestaurant;}
    public function getName() : string { return $this->name;}
    public function getClassification() : int { return $this->classification;}
    public function getAddress() : string { return $this->address;}
    public function getDescription() : string { return $this->description;}
    public function getServiceHours() : string { return $this->serviceHours;}
    public function getMaxPrice() : int { return $this->maxPrice;}
    public function getMinPrice() : int { return $this->minPrice;}
    public function getUser() : User { return $this->user;}
    public function getMenu() : Menu { return $this->menu;}

    public function setIdRestaurant(int $idRestaurant) : void {
          $tempIdRestaurant = filter_var($idRestaurant, FILTER_SANITIZE_NUMBER_INT);
          $this->idRestaurant = $tempIdRestaurant; 
      }

    public function setName (string $name) : void {
          $tempName = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
          $this->name = $tempName; 
      }

      static function setUserID(PDO $db, string $userOld, string $userNew) : void {
        $stmt = $db->prepare('UPDATE Restaurant SET
                              user = :userNew
                              WHERE user = :userOld');
        $stmt->bindValue(':userOld', $userOld, PDO::PARAM_STR);
        $stmt->bindValue(':userNew', $userNew, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function setIClassification(int $classification) : void {
          $tempClassification = filter_var($classification, FILTER_SANITIZE_NUMBER_INT);
          $this->classification = $tempClassification; 
      }

    public function setAdress(string $address) : void {
      $tempAddress = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->address = $tempAddress; 
      }

    public function setDescription (string $description) : void {
      $tempDescription = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->description = $tempDescription; 
      }

    public function setServiceHours(string $serviceHours) : void {
      $tempServiceHours = filter_var($serviceHours, FILTER_SANITIZE_ENCODED);
      $this->serviceHours = $tempServiceHours; 
      }

    public function setMaxPrice(int $maxPrice) : void {
          $tempMaxPrice = filter_var($maxPrice, FILTER_SANITIZE_NUMBER_INT);
          $this->maxPrice = $tempMaxPrice; 
      }  

    public function setMinPrice(int $minPrice) : void {
          $tempMinPrice = filter_var($minPrice, FILTER_SANITIZE_NUMBER_INT);
          $this->maxPrice = $tempMinPrice; 
      }
    

    static function getRestaurant(PDO $db, int $idRestaurant) : Restaurant {
      $stmt = $db->prepare('SELECT * FROM Restaurant WHERE idRestaurant = ?');
      $stmt->execute(array($idRestaurant));
      $restaurant = $stmt->fetch();
      return new Restaurant(
          $restaurant['idRestaurant'],
          $restaurant['name'],
          $restaurant['classification'],
          $restaurant['address'],
          $restaurant['description'],
          $restaurant['serviceHours'],
          $restaurant['maxPrice'],
          $restaurant['minPrice'],
          User::getUser($db,$restaurant['user']),
          Menu::getMenu($db,$restaurant['menu'])
        );
  }

    static function getRestaurants(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT * 
                            FROM Restaurant 
                            LIMIT ?');
      $stmt->execute(array($count));
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          $restaurant['idRestaurant'],
          $restaurant['name'],
          $restaurant['classification'],
          $restaurant['address'],
          $restaurant['description'],
          $restaurant['serviceHours'],
          $restaurant['maxPrice'],
          $restaurant['minPrice'],
          User::getUser($db,$restaurant['user']),
          Menu::getMenu($db,$restaurant['menu'])
        );
        //echo $restaurant['name'];
      }
      return $restaurants;
    }

    static public function restaurantExists(PDO $db, string $idRestaurant) : bool {
      $stmt = $db->prepare('SELECT idRestaurant
                            FROM Restaurant
                            WHERE idRestaurant =:idRestaurant');
      $stmt->bindParam(':idRestaurant', $idRestaurant);
      $stmt->execute();
      $restaurants = $stmt->fetchAll();
      $numRestaurants = count($restaurants);
      return $numRestaurants >= 1;
    }

    public function addRestaurant(PDO $db): void{
          $stmt = $db->prepare('INSERT INTO Restaurant
                                (name, classification, address, description, serviceHours, maxPrice, minPrice, user, menu)
                                VALUES
                                (:name, :classification, :address, :description, :serviceHours, :maxPrice, :minPrice, :user, :menu)');
          $stmt->bindValue(':name', $this->getName(), PDO::PARAM_STR);
          $stmt->bindValue(':classification', $this->getClassification(), PDO::PARAM_INT);
          $stmt->bindValue(':address', $this->getAddress(), PDO::PARAM_STR);
          $stmt->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);
          $stmt->bindValue(':serviceHours', $this->getServiceHours(), PDO::PARAM_STR);
          $stmt->bindValue(':maxPrice', $this->getMaxPrice(), PDO::PARAM_INT);
          $stmt->bindValue(':minPrice', $this->getMinPrice(), PDO::PARAM_INT);
          $stmt->bindValue(':user', $this->getUser());
          $stmt->bindValue(':menu', $this->getMenu());
          $stmt->execute();
      }

      public function addCategoryToRestaurant(PDO $db, int $idRestaurant, string $idCategory): void{
          $stmt = $db->prepare('INSERT INTO RestaurantCategory
                                (restaurant, category)
                                VALUES
                                (:restaurant, :category)');
          $stmt->bindValue(':restaurant', $this->getIdRestaurant(), PDO::PARAM_INT);
          $stmt->bindValue(':category', Category::getCategory($db, $idCategory), PDO::PARAM_INT);
          $stmt->execute();
      }

    function removeRestaurantById(PDO $db, int $idRestaurant) : void {
        $stmt = $db->prepare('DELETE FROM Restaurant
                              WHERE idRestaurant=:idRestaurant');
        $stmt->bindValue(':idRestaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
    }  

    static function getRestaurantMenu(PDO $db, Restaurant $restaurant) : Menu {
        $idRestaurant = $restaurant->getIdRestaurant();
        $stmt = $db->prepare('SELECT menu 
                              FROM Restaurant 
                              WHERE menu = :menu');
        $stmt->bindValue(':idRestaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
        $idMenu = $stmt->fetch();
        return Menu::getMenu($db, $idMenu);
      }

    static function getRestaurantByName(PDO $db, string $name): Restaurant {
        $stmt = $db->prepare('SELECT idRestaurant 
                              FROM Restaurant 
                              WHERE name = :name');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $Restaurant = $stmt->fetch();
        return Restaurant::getRestaurant($db,$Restaurant['idRestaurant']);
    }

    static function getRestaurantByOwner(PDO $db, string $username): int {
        $stmt = $db->prepare('SELECT idRestaurant 
                              FROM Restaurant 
                              WHERE user = :user');
        $stmt->bindValue(':user', $username, PDO::PARAM_STR);
        $stmt->execute();
        $idRestaurant = $stmt->fetch();
        return $idRestaurant;
    }

    static function getRestaurantNameById(PDO $db, int $id): string {
      $stmt = $db->prepare('SELECT name 
                            FROM Restaurant 
                            WHERE idRestaurant = :id');
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $name = $stmt->fetch();
      $n = $name['name'];
      return $n;
  }
    
}
?>