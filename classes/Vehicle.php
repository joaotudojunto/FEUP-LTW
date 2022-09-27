<?php

require_once '/classes/User.php';

class Vehicle{
    private int $idvehicle;
    private string $vehicle;
    private string $licensePlate;
    private User $user;

    public function __construct(
        int $idVehicle,
        string $vehicle,
        string $licensePlate,
        User $user  
    ){
        $this->idVehicle = $idVehicle;
        $this->vehicle= $vehicle;
        $this->licensePlate = $licensePlate;
        $this->user = $user;
    }

    public function getIdVehicle() : ?int { return $this->idVehicle;}
    public function getVehicleModel() : string { return $this->vehicle;}
    public function getLicensePlate() : string { return $this->licensePlate;}
    public function getUser() : User { return $this->user;}


    public function setIdVehicle(int $idVehicle) : void {
        $tempIdVehicle = filter_var($idVehicle, FILTER_SANITIZE_NUMBER_INT);
        $this->idvehicle = $tempIdVehicle; 
    }

    public function setVehicle(string $vehicle) : void {
    $tempVehicle = filter_var($vehicle, FILTER_SANITIZE_SPECIAL_CHARS);
    $this->type = $tempVehicle; 
    }

    public function setLicensePlate(string $licensePlate) : void {
    $tempLicensePlate = filter_var($licensePlate, FILTER_SANITIZE_SPECIAL_CHARS);
    $this->licensePlate = $tempLicensePlate; 
    }
    public function setUser(User $user) : void { 
    $this->user = $user; 
    }

    static function getVehicle(PDO $db, string $idVehicle) : Vehicle {
      $stmt = $db->prepare('SELECT *
                            FROM Vehicle
                            WHERE idVehicle = ?');
      $stmt->execute(array($idVehicle));
      $vehicle = $stmt->fetch();
      return new Vehicle(
          $vehicle['idVehicle'],
          $vehicle['vehicle'],
          $vehicle['licensePlate'],
          $vehicle['user']
        );
    }

    public function addToDatabase(PDO $db) : void {
        $stmt = $db->prepare('INSERT INTO Vehicle (vehicle, licensePlate, user)
                              VALUES (:vehicle, :licensePlate, :user)');
        $stmt->bindValue(':vehicle', $this->getVehicleModel(), PDO::PARAM_STR);
        $stmt->bindValue(':licensePlate', $this->getLicensePlate(), PDO::PARAM_STR);
        $stmt->bindValue(':user', $this->user->getUsername(), PDO::PARAM_INT);
        $stmt->execute();
        $this->idVehicle = $db->lastInsertId();
    }

}
   
?>