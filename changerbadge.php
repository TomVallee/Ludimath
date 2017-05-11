<?php

require_once "includes/functions.php";
session_start();
$badge=$_GET['badge'];     
changerbadge($badge, 'tbazin');
?>
