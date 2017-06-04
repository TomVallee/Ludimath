<?php
require_once "includes/functions.php";
session_start();

if(isUserConnected())
{
    $badge=$_GET['badge'];     
    changerbadge($badge, $_SESSION['id']);
}
?>