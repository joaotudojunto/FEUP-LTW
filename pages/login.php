<?php
    require_once('../templates/login.tpl.php');
    require_once('../templates/common.tpl.php');
    require_once('../utils/session.php');

    drawHeader();
    drawLoginForm();
    drawFooter();
?>