<?php

class Image{ 

    private int $idImage;
    private string $title;
    private int $restaurant;

    public function __construct(
        int $idImage,
        string $title,
        int $restaurant
        ){
        $this->idImage = $idImage;
        $this->title = $title;
        $this->restaurant = $restaurant;
    }

    public function getIdImage() : ?int { return $this->idImage;}
    public function getTitle() : string { return $this->title;}
    public function getRestaurant() : int { return $this->restaurant;}

    static function getImage(PDO $db, int $idImage) : Image {
        $stmt = $db->prepare('SELECT * 
                              FROM Image
                              WHERE idImage = ?');
        $stmt->bindValue(':image', $idImage, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch();
        return new Image(
            $image['idImage'],
            $image['title'],
            $image['restaurant'],
            );
    }

    static function getImageByRestaurant(PDO $db, int $idRestaurant) : Image {
        $stmt = $db->prepare('SELECT * 
                              FROM Image
                              WHERE restaurant = :restaurant');
        $stmt->bindValue(':restaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch();
        return new Image(
            $image['idImage'],
            $image['title'],
            $image['restaurant'],
            );
    }
}
?>