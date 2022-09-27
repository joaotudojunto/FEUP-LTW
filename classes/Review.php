<?php

require_once '../classes/User.php';
require_once '../classes/Restaurant.php';

class Review{

    private int $idReview;
    private string $postedTime;
    private string $text;
    private int $classification;
    private User $user;
    private Restaurant $restaurant;

    public function __construct(
        int $idNotification,
        string $postedTime,
        string $text,
        int $classification,
        User $user,
        Restaurant $restaurant 
    ){
        $this->idNotification = $idNotification;
        $this->postedTime = $postedTime;
        $this->text = $text;
        $this->classification = $classification;
        $this->user = $user;
        $this->restaurant = $restaurant;
    }

    public function getIdReview() : ?int { return $this->idReview;}
    public function getPostedTime() : string { return $this->postedTime;}
    public function getText() : string { return $this->text;}
    public function getClassification() : int { return $this->classification;}
    public function getUser() : User { return $this->user;}
    public function getRestaurant() : Restaurant { return $this->restaurant;}

    public function setIdReview(int $idReview) : void {
        $tempIdReview = filter_var($idReview, FILTER_SANITIZE_NUMBER_INT);
        $this->idReview = $tempIdReview; 
    }

    public function setPostedTime(string $postedTime) : void {
        $tempPostedTime = filter_var($postedTime, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->postedTime = $tempPostedTime; 
    }

    public function setText(string $text) : void {
        $tempText = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->text = $tempText; 
    }

    public function setIClassification(int $classification) : void {
          $tempClassification = filter_var($classification, FILTER_SANITIZE_NUMBER_INT);
          $this->classification = $tempClassification; 
      }
    
      static function setUserID(PDO $db, string $userOld, string $userNew) : void {
        $stmt = $db->prepare('UPDATE Review SET
                              user = :userNew
                              WHERE user = :userOld');
        $stmt->bindValue(':userOld', $userOld, PDO::PARAM_STR);
        $stmt->bindValue(':userNew', $userNew, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function setRestaurant(Restaurant $restaurant) : void {
        $this->restaurant = $restaurant;
    }

    static function getReview(PDO $db, string $idReview) : Review {
      $stmt = $db->prepare('SELECT *
                            FROM Review 
                            WHERE idReview = ?');
      $stmt->execute(array($idReview));
      $review = $stmt->fetch();
      return new Review(
          $review['idReview'],
          $review['postedTime'],
          $review['text'],
          $review['classification'],
          User::getUser($db,$review['user']),
          $review['restaurant'],
        );
    }

    static function getRestReview(PDO $db, int $restaurant) : array {
        $stmt = $db->prepare('SELECT * FROM Review WHERE restaurant = ?');
        $stmt->execute(array($restaurant));
        //$stmt->execute($menu);
        $reviews = array();
        
        while ($restReviews = $stmt->fetch()) {
            $reviews[] = new Review(
                $restReviews['idReview'],
                $restReviews['postedTime'],
                $restReviews['text'],
                $restReviews['classification'],
                User::getUser($db,$restReviews['user']),
                Restaurant::getRestaurant($db,$restReviews['restaurant']),
              );
        }
        
        return $reviews;
      }

    public function deleteReview(PDO $db) : void {
        $stmt = $db->prepare('DELETE FROM Comment 
                              WHERE idReview=:idReview');
        $stmt->bindValue(':idReview', $this->getIdReview(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addRestaurantReview(PDO $db, string $text, int $classification, string $username, int $idRestaurant) : int {
        $stmt = $db->prepare('INSERT INTO Review (text, classification, user, restaurant)
                            VALUES (:pet, :user, :answerTo, :text)');
        $stmt->bindValue(':text', $text, PDO::PARAM_STR);
        $stmt->bindValue(':classification', $classification, PDO::PARAM_INT);
        $stmt->bindValue(':user', $username, PDO::PARAM_STR);
        $stmt->bindValue(':restaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
        $idReview = $db->lastInsertId();
        return $idReview;
    }

    function deleteRestaurantComment(PDO $db, int $idReview){
        $stmt = $db->prepare('DELETE FROM Review
                              WHERE idReview=:review');
        $stmt->bindValue(':review', $idReview, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function editReview(PDO $db, string $text, int $classification){
    $stmt = $db->prepare('UPDATE Review
                          SET text=:text, classification = :classification
                          WHERE idReview = :review');
    $stmt->bindValue(':text', $text, PDO::PARAM_INT);
    $stmt->bindValue(':classification', $classification, PDO::PARAM_INT);
    $stmt->bindValue(':review', $this->getIdReview(), PDO::PARAM_INT);
    $stmt->execute();
    }
}

?>