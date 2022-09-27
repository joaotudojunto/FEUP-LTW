<?php

require_once 'Restaurant.php';

class Menu {
     
    private int $idMenu;

    public function __construct(
        int $idMenu,
    ){
        $this->idMenu = $idMenu;
    }

    public function getIdMenu() : ?int { return $this->idMenu;}

    public function setIdMenu(int $idMenu) : void {
          $tempIdMenu = filter_var($idMenu, FILTER_SANITIZE_NUMBER_INT);
          $this->idMenu = $tempIdMenu; 
    }

    static function getMenu(PDO $db, int $idMenu) : Menu {
        $stmt = $db->prepare('SELECT idMenu FROM Menu WHERE idMenu = :menu');
        $stmt->bindValue(':menu',$idMenu, PDO::PARAM_INT);
        $stmt->execute();
        $menu = $stmt->fetch();
        return new Menu($menu['idMenu']);
  }

  static function getMenuByCategory(PDO $db,int $idCategory) : Menu {
        $tempIdDish = Dish::getDishIdByCategory($db, $idCategory);
        $tempIdMenu = Dish::getDishMenuId($db, $tempIdDish);
        $stmt = $db->prepare('SELECT * 
                              FROM Menu 
                              WHERE idMenu = :menu');
        $stmt->bindValue(':menu',$tempIdMenu, PDO::PARAM_INT);
        $stmt->execute();
        $menu = $stmt->fetch();
        return new Menu($menu['idMenu']);
  }

  static function getMenuDish(PDO $db, int $menu) : array {
    $stmt = $db->prepare('SELECT dish FROM MenuDish WHERE menu = ?');
    $stmt->execute(array($menu));
    //$stmt->execute($menu);
    $dishes = array();
    while ($menuDish = $stmt->fetch()) {
        $dishes[] = $menuDish['dish'];
    }
    return $dishes;
  }

}

?>