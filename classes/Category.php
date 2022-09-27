<?php

//require_once '/classes/Restaurant.php';

class Category {
     
    private int $idCategory;
    private string $name;

    public function __construct(
        int $idCategory,
        string $name,
    ){
        $this->idCategory = $idCategory;
        $this->name = $name;
    }

    public function getIdCategory() : ?int { return $this->idCategory;}
    public function getName() : string { return $this->name;}

    public function setIdCategory(int $idCategory) : void {
          $tempIdCategory = filter_var($idCategory, FILTER_SANITIZE_NUMBER_INT);
          $this->idCategory = $tempIdCategory; 
    }

    public function setName(string $name) : void {
          $tempName = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
          $this->name = $tempName; 
    }

    static function getCategory(PDO $db, int $idCategory) : Category {
        $stmt = $db->prepare('SELECT * 
                              FROM Category 
                              WHERE idCategory = ?');
        $stmt->execute(array($idCategory));
        $category = $stmt->fetch();
        return new Category(
            $category['idCategory'],
            $category['name']
        );
    }
    
    static function getCategoryIdByName(PDO $db, string $name) : int {
        $stmt = $db->prepare('SELECT * 
                              FROM Category 
                              WHERE name = :name');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $idCategory = $stmt->fetch();
        return $idCategory;
    }

    static function getCategories(PDO $db) : array {
        $stmt = $db->prepare('SELECT * 
                              FROM Category 
                              ');
        $stmt->execute();
        $categories = array();
        while ($category = $stmt->fetch()) {
        $categories[] = new Category(
            $category['idCategory'],
            $category['name']
        );
        }
        return $categories;
    }
}

?>