
<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/Review.php');

    $db = getDatabaseConnection();

    $review = Review::getReview($db, $_POST['idReview']);
    $user = $review->getUser();

    if($session->isLoggedIn() && $sess === $user->getUsername())
    if ($session->isLoggedIn() && $session->getUsername() === $user->getUsername()){
        try {
            $review->deleteReview($db);
        }
        catch(Exception $e) { 
            echo "Error deleting Review.";
        }
    }
    header("Location: ". $_SERVER['HTTP_REFERER']);

?>