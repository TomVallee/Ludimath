<?php

//creation DB
$mysql = new PDO("mysql:host=localhost", "root", "");
try {
    $sql = file_get_contents('database.sql');
    $mysql->exec($sql);
    echo "Succes Creation; ";
} catch (Exception $ex) {
    die("Erreur fatale :" . $ex->getMessage());
}


require_once("../includes/functions.php");

//Structure DB
try{
    $sql=file_get_contents("structure.sql");
    getDB()->exec($sql);
    echo "Succes Structure; ";
} catch (Exception $ex) {
    die("Erreur fatale :" . $ex->getMessage());
}

//contenu
try{
    $sql=file_get_contents("content.sql");
    getDB()->exec($sql);
    echo "Succes Contenu; ";
} catch (Exception $ex) {
    die("Erreur fatale :" . $ex->getMessage());
}


?>