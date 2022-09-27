<?php
    require_once('../templates/paydone.tpl.php');
    require_once('../templates/common.tpl.php');
    require_once('../templates/main.tpl.php');
    require_once('../templates/profile.tpl.php');
    require_once('../utils/session.php');

    $session = new Session();

    drawHeaderProfile($session);
    drawPayDone();
    drawFooter();
?>