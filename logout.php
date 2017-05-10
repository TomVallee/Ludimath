<?php
require_once "includes/functions.php";
session_start();
session_destroy();
redirect("accueil_rentre.php");
header('Location : ../index.php');