<?php

require_once '../classes/Category.php';

class Dish{ 

    private int $idDish;
    private string $name;
    private string $description;
    private int $price;
    private Category $category;

    public function __construct(
        int $idDish,
        string $name,
        string $description,
        int $price,
        Category $category
        ){
        $this->idDish = $idDish;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
    }

    public function getIdDish() : ?int { return $this->idDish;}
    public function getName() : string { return $this->name;}
    public function getDescription() : string { return $this->description;}
    public function getPrice() : int { return $this->price;}
    public function getCategory() : Category { return $this->ctageory;}

    public function setIdDish(int $idDish) : void {
        $tempIdDish = filter_var($idDish, FILTER_SANITIZE_NUMBER_INT);
        $this->idDish= $tempIdDish; 
    }

    public function setName(string $name) : void {
        $tempName = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->name = $tempName; 
    }

    public function setDescription(string $description) : void {
        $tempDescription = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->description = $tempDescription; 
    }

    public function setPrice(int $price) : void {
        $tempPrice = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
        $this->price = $tempPrice; 
    }
    
    public function setCategory(Category $category) : void { 
        $this->category = $category; 
    }

    static function getDish(PDO $db, int $idDish) : Dish {
        $stmt = $db->prepare('SELECT * 
                              FROM Dish
                              WHERE idDish = ?');
        $stmt->execute(array($idDish));
        $dish = $stmt->fetch();
        return new Dish(
            $dish['idDish'],
            $dish['name'],
            $dish['description'],
            $dish['price'],
            Category::getCategory($db,$dish['category']),
            );
    }

    static function getDishIdByCategory(PDO $db, string $category) : int {
        $stmt = $db->prepare('SELECT idDish
                              FROM Dish
                              WHERE category = :category
                              LIMIT 1');
        $stmt->bindValue(':category', $category, PDO::PARAM_INT);
        $stmt->execute();
        $dish = $stmt->fetch();
        return $dish;

    }

        static function getDishMenuId(PDO $db, string $idDish) : int {
        $stmt = $db->prepare('SELECT menu
                              FROM MenuDish
                              WHERE dish = :dish');
        $stmt->bindValue(':dish', $idDish, PDO::PARAM_INT);
        $stmt->execute();
        $menu = $stmt->fetch();
        return $menu;
    }

    public function deleteDish(PDO $db) : void {
        $stmt = $db->prepare('DELETE FROM Dish WHERE idDish =:idDish');
        $stmt->bindValue(':idDish', $this->getIdDish(), PDO::PARAM_INT);
        $stmt->execute();
    }

    


}

?>