<?php

require_once '/classes/User.php';

class Notification{
    private int $idNotification;
    private string $type;
    private string $content;
    private int $checked;
    private User $user;

    public function __construct(
        int $idNotification,
        string $type,
        string $content,
        int $checked,
        User $user  
    ){
        $this->idNotification = $idNotification;
        $this->type = $type;
        $this->content = $content;
        $this->checked = $checked;
        $this->user = $user;
    }

    public function getIdNotification() : ?int { return $this->idNotification;}
    public function getType() : string { return $this->type;}
    public function getContent() : string { return $this->content;}
    public function isChecked() : int { return $this->checked;}
    public function getUser() : User { return $this->user;}

    public function setIdNotification(int $idNotification) : void {
        $tempIdNotification = filter_var($idNotification, FILTER_SANITIZE_NUMBER_INT);
        $this->idNotification = $tempIdNotification; 
    }

    public function setType(string $type) : void {
        $tempType = filter_var($type, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->type = $tempType; 
    }

    public function setContent(string $content) : void {
        $tempContent = filter_var($content, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->content = $tempContent; 
    }

    public function setNotificationChecked (int $isChecked) : void {
        $tempChecked = filter_var($isChecked, FILTER_SANITIZE_NUMBER_INT);
        $this->checked = $tempChecked; 
    }
    
    public function setUser(User $user) : void { 
        $this->user= $user; 
    }

    public function setChecked() : void {
        $this->checked = 1;
    }

    static function getNotification(PDO $db, string $idNotification) : Notification {
      $stmt = $db->prepare('SELECT *
                            FROM User 
                            WHERE idNotification = ?');
      $stmt->execute(array($idNotification));
      $notification = $stmt->fetch();
      return new Notification(
          $notification['idNotification'],
          $notification['type'],
          $notification['content'],
          $notification['checked'],
          $notification['user']
        );
    }

    static function addNotification(PDO $db, string $username, string $type, string $content) : void {
            $stmt = $db->prepare('INSERT INTO Notification (type, content, user)
                                VALUES (:type, :content, :user)');
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
            $stmt->bindValue(':content', $content, PDO::PARAM_STR);
            $stmt->bindValue(':user', User::getUser($db,$username), PDO::PARAM_INT);
            $stmt->execute();
    }
    
    function getUserNotifications(PDO $db, string $username) : array {
        $stmt = $db->prepare('SELECT *
                            FROM Notification JOIN User 
                            ON Notification.user = User.username
                            WHERE User.username =:username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $notifications = $stmt->fetchAll();
        return $notifications;
    }


    function removeNotificationById(PDO $db, int $idNotification) : void {
        $stmt = $db->prepare('DELETE FROM Notification
                              WHERE idNotification=:idNotification');
        $stmt->bindValue(':idNotification', $idNotification, PDO::PARAM_INT);
        $stmt->execute();
    }


    function removeUserNotifications(PDO $db, string $username) : void {
        $notifications = $this->getUserNotifications($db,$username);
        foreach($notifications as $notification)
            $this->removeNotificationById($db, $notification['idNotification']);
    }

    static public function getNotificationFromDatabase(PDO $db, int $idNotification) : ?Notification {
        $stmt = $db->prepare('SELECT * 
                              FROM Notification 
                              WHERE idNotification=:idNotification');
        $stmt->bindValue(':idNotification', $idNotification, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS);
        $stmt->execute();
        $notification = $stmt->fetch();
        if($notification == false) return null;
        return $notification;
    }

    function checkNotification(PDO $db, int $idNotification) {
        $stmt = $db->prepare('UPDATE Notification 
                              SET checked = 1
                              WHERE idNotification=:idNotification');
        $stmt->bindValue(':notificationId', $idNotification, PDO::PARAM_INT);
        $this->setChecked();
        $stmt->execute();
    }

}
?>