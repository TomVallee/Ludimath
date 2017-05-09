<?php
require_once "includes/functions.php";
session_start();
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <div><h1 align="center"> Profil </h1></div>
        <h2>Noemie Guerin</h2>
        <hr>
            <div class="div2"> 
        <h4>Classement général: </h4>
            <ul>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_pre` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'];echo  $top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_deux` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'];echo  $top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_trois` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'];echo  $top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_quat` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'];
                echo  $top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_cinq` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'];echo  $top['utilisateur_prenom'];
                ?></li>
        </ul>
        </div> 
        <section>
        <p style="text-align:center">Experience :  <img src="images/progression/25%25.png"></p> 
        <hr>

        <div class="div1">
            <h3>Mes derniers badges</h3>
            <img src="images/Badge.png">
        </div>
        <div class="div1">
            <h3>Mon meilleur score</h3>
            <img src="images/Badge.png">
        </div>
        </section>
        
    </div>
</body>
        