<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/User.php');
    require_once(__DIR__ . '/../classes/Review.php');

    $db = getDatabaseConnection();

    if (!$session->isLoggedIn()) die(header('Location: /'));

    $review = Review::getReview($db, $_POST['idReview']);

    if ($review->getUser()->getUsername() != $session->getUsername()) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }
    try {
        $review -> editReview(
            $db,
            $_POST['text'],
            $_POST['classification']
            );
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } catch (Exception $e) {
        echo "Error editing the following Review.";
    }
?>