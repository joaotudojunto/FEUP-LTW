<?php
    require_once('../templates/about.tpl.php');
    require_once('../templates/common.tpl.php');
    require_once('../templates/profile.tpl.php');
    require_once('../utils/session.php');
    require_once('../templates/profile.tpl.php');

    $session = new Session();

    drawHeaderProfile($session);
    drawAbout();
    drawFooter();
?>