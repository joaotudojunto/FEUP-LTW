<?php
    require_once('../templates/checkout.tpl.php');
    require_once('../templates/common.tpl.php');
    require_once('../templates/main.tpl.php');
    require_once('../templates/profile.tpl.php');
    require_once('../templates/editprofile.tpl.php');
    require_once('../utils/session.php');

    $session = new Session();

    drawHeaderProfile($session);
    drawEditForm();
    drawFooter();
?>