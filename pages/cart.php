<?php
    require_once('../templates/cart.tpl.php');
    require_once('../templates/common.tpl.php');
    require_once('../templates/profile.tpl.php');
    require_once('../utils/session.php');

    $session = new Session();

    drawHeaderProfile($session);;
    drawCart();
    drawFooter();
?>