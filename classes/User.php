<?php

class UsernameExistsException extends RuntimeException{}
class UsernameDontExistsException extends RuntimeException{}
class InvalidEditException extends RuntimeException{}

class User{
 
    private string $username;
    private string $userType;
    private string $password;
    private string $name;
    private string $phoneNumber;
    private string $address;
    private string $email;
    private string $description;
    private string $registeredDate;
    
    public function __construct(
        string $username,
        string $userType,
        string $password,
        string $name,
        string $phoneNumber,
        string $address,
        string $email,
        string $description)
    {
        $this->username = $username;
        $this->userType = $userType;
        $this->password = $password;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->email = $email;
        $this->desription = $description;
    }

    public function getUsername() : string { return $this->username;}
    public function getUserType() : string { return $this->userType;}
    public function getPassword() : string { return $this->password;}
    public function getName() : string { return $this->name;}
    public function getPhoneNumber() : string { return $this->phoneNumber;}
    public function getAddress() : string { return $this->address;}
    public function getEmail() : string { return $this->email;}
    public function getDescription() : string { return $this->description;}
    public function getRegisteredDate() : string { return $this->registeredDate;}

     public function setUsername(string $username) : void {
        $tempUsername = filter_var($username, FILTER_SANITIZE_ENCODED);
        $this->username = $tempUsername; 
    }

    public function setUserType(string $userType) : void {
        $tempUserType = filter_var($userType, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->userType = $tempUserType; 
    }

    public function setPassword(string $password) : void {
        $this->password = $password; 
    }

    public function setName (string $name) : void {
        $tempName = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->name = $tempName; 
    }

    public function setPhoneNumber(string $phoneNumber) : void {
      $tempPhoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->phoneNumber = $tempPhoneNumber; 
    }

    public function setAddress(string $address) : void {
      $tempAddress = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->address = $tempAddress; 
    }
    
    public function setEmail(string $email) : void { 
        $tempEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->email= $tempEmail; 
    }

    public function setDescription (string $description) : void {
      $tempDescription = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
      $this->description = $tempDescription; 
    }

    public function updateUser(PDO $db) : void {
        $stmt = $db->prepare('UPDATE User SET
                        username = :username,
                        userType = :userType,
                        password = :password,
                        name = :name,
                        phoneNumber = :phoneNumber,
                        address = :address,
                        email = :email
                        WHERE username = :username');
                        
        $stmt->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(':userType', $this->getUserType(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':phoneNumber', $this->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(':address', $this->getAddress(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
    }

    static public function editPassword(PDO $db, string $oldPassword, string $newPassword) : void {
         if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=\S*[\d])[a-zA-Z\d]{7,}$/', $newPassword)) 
            throw new InvalidArgumentException("Password need a min of 7 characters, 1 Uppercase, and 1 number.");
            $options = ['cost' => 12,];
            $stmt = $db->prepare('UPDATE User SET
            password = :newPassword
            WHERE password = :oldPassword');
            $stmt->bindValue(':newPassword', $newPassword, PDO::PARAM_STR);
            $stmt->bindValue(':oldPassword', $oldPassword, PDO::PARAM_STR);
            $stmt->execute();
    }

    static public function editUsername(PDO $db, string $oldUsername, string $newUsername) : void{
       $stmt = $db->prepare('UPDATE User SET
                        username = :newUsername
                        WHERE username = :oldUsername');
      $stmt->bindValue(':newUsername', $newUsername, PDO::PARAM_STR);
      $stmt->bindValue(':oldUsername', $oldUsername, PDO::PARAM_STR);
      $stmt->execute();
    }

    static public function editName(PDO $db, string $oldName, string $newName) : void{
      $stmt = $db->prepare('UPDATE User SET
                       name = :newName
                       WHERE name = :oldName');
     $stmt->bindValue(':oldName', $oldName, PDO::PARAM_STR);
     $stmt->bindValue(':newName', $newName, PDO::PARAM_STR);
     $stmt->execute();
   }

   static public function editAddress(PDO $db, string $oldAddress, string $newAddress) : void{
    $stmt = $db->prepare('UPDATE User SET
                     address = :newAddress
                     WHERE address = :oldAddress');
   $stmt->bindValue(':oldAddress', $oldAddress, PDO::PARAM_STR);
   $stmt->bindValue(':newAddress', $newAddress, PDO::PARAM_STR);
   $stmt->execute();
 }

 static public function editUserType(PDO $db, string $oldType, string $newType) : void{
  $stmt = $db->prepare('UPDATE User SET
                   userType = :newType
                   WHERE userType = :oldType');
 $stmt->bindValue(':oldType', $oldType, PDO::PARAM_STR);
 $stmt->bindValue(':newType', $newType, PDO::PARAM_STR);
 $stmt->execute();
}

static public function editPhoneNumber(PDO $db, string $oldNumber, string $newNumber) : void{
  $stmt = $db->prepare('UPDATE User SET
                   phoneNumber = :newNumber
                   WHERE phoneNumber = :oldNumber');
 $stmt->bindValue(':oldNumber', $oldNumber, PDO::PARAM_STR);
 $stmt->bindValue(':newNumber', $newNumber, PDO::PARAM_STR);
 $stmt->execute();
}

  static function getUser(PDO $db, string $username) : User {
        $stmt = $db->prepare('SELECT * 
                              FROM User 
                              WHERE username = ?');
        $stmt->execute(array($username));
        $user = $stmt->fetch();
        return new User(
            $user['username'],
            $user['userType'],
            $user['password'],
            $user['name'],
            $user['phoneNumber'],
            $user['address'],
            $user['email'],
            $user['description'],
            $user['registeredDate'],
          );
      }

  static function searchUsers(PDO $db, string $search, int $count) : array {
  $stmt = $db->prepare('SELECT * 
                        FROM User 
                        WHERE Name LIKE ? LIMIT ?');
  $stmt->execute(array($search . '%', $count));
  $users = array();
  while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['username'],
          $user['userType'],
          $user['password'],
          $user['name'],
          $user['phoneNumber'],
          $user['address'],
          $user['email'],
          $user['description'],
          $user['registeredDate'],
        );
      }
  return $users;
}
  
    static function getUserByType(PDO $db, string $username, string $userType) : User {
      $stmt = $db->prepare('SELECT * 
                            FROM User
                            WHERE username = ? and userType = :userType');
      $stmt->execute(array($username));
      $stmt->bindValue(':userType', $userType, PDO::PARAM_STR);
      $user = $stmt->fetch();
      return new User(
          $user['username'],
          $user['userType'],
          $user['password'],
          $user['name'],
          $user['phoneNumber'],
          $user['address'],
          $user['email'],
          $user['description'],
          $user['registeredDate'],
        );
    }

     static function getUsers(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT * 
                            FROM User 
                            LIMIT ?');
      $stmt->execute(array($count));
      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['username'],
          $user['userType'],
          $user['password'],
          $user['name'],
          $user['phoneNumber'],
          $user['address'],
          $user['email'],
          $user['description'],
          $user['registeredDate'],
        );
      }
      return $users;
    }

    public function addUser(PDO $db) : void {
        $stmt = $db->prepare('INSERT INTO User(username, userType, password, name, 
                                    phoneNumber, address, email) 
                              VALUES 
                                    (:username, :userType, :password, :name, 
                                      :phoneNumber, :address, :email)');
        $stmt->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(':userType', $this->getUserType(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':phoneNumber', $this->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(':address', $this->getAddress(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
    }


    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('SELECT *
                            FROM User
                            WHERE email = :email AND password = :password');
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
      
      if ($user = $stmt->fetch()) {
        return new User(
          $user['username'],
          $user['userType'],
          $user['password'],
          $user['name'],
          $user['phoneNumber'],
          $user['address'],
          $user['email'],
          $user['description'],
          $user['registeredDate'],
        );
      } else return null;
    }

    public function editUser(PDO $db, string $oldUsername, string $newUsername, string $name) {
        $user = User::getUser($db,$oldUsername);
        if ($newUsername === "new") 
            throw new InvalidEditException("Username ".$newUsername." is invalid.");
        $user->setName($name);
        $user->updateUser($db);
        if($oldUsername != $newUsername && User::userExists($db, $newUsername))
            throw new UsernameExistsException("Username ".$newUsername." already exists.");
        $stmt = $db->prepare('UPDATE User 
                              SET username = :newUsername 
                              WHERE username = :oldUsername');
        $stmt->bindValue(':newUsername', $newUsername);
        $stmt->bindValue(':oldUsername', $oldUsername);
        $stmt->execute();
    }

    static public function userExists(PDO $db, string $username) : bool {
        $stmt = $db->prepare('SELECT username
                              FROM User
                              WHERE username =:username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $numUsers = count($users);
        return $numUsers >= 1;
    }

    function removeUserById(PDO $db, string $username) : void {
        $stmt = $db->prepare('DELETE FROM User
                              WHERE username=:username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
    } 

    public function getUserFoodOrders(PDO $db) : array {
        $stmt = $db->prepare('SELECT * 
                              FROM FoodOrder
                              WHERE user=:username');
        $stmt->setFetchMode(PDO::FETCH_CLASS);
        $stmt->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
        $stmt->execute();
        $foodOrders = $stmt->fetchAll();
        return $foodOrders;
    }

    public function removeOwnerRestaurant(PDO $db, int $idRestaurant) : void {
        $stmt = $db->prepare('DELETE FROM Restaurant
                              WHERE idRestaurant = :restaurant');
        $stmt->bindValue(':restaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>