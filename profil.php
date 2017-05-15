<?php
require_once "includes/functions.php";
session_start();

$reqUser = getDb()->prepare('SELECT * FROM user WHERE utilisateur_id=?');
$reqUser->execute(array($_SESSION['id']));
$user = $reqUser->fetch();
$nom = $user['utilisateur_nom'];
$prenom = $user['utilisateur_prenom'];

$reqNiv = getDb()->prepare('SELECT * FROM niveau WHERE niveau_id=?');
$reqNiv->execute(array($user['utilisateur_niveau']));
$niv = $reqNiv->fetch();

$query= getDb()->query("SELECT succes_id FROM succes");

$progr = $user['utilisateur_experience']/$niv['niveau_experience'];
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <div><h1 align="center"> Profil </h1></div>
        <h2><?php echo $nom.' '.$prenom;?></h2>
        <hr>
            <div class="div2"> 
        <h4>Classement général: </h4>
            <ul>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_pre` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_deux` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_trois` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_quat` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_cinq` FROM `top` WHERE `top_id` =0)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
        </ul>
        </div> 
        <section class="sec3">
        <p style="text-align:center">Experience : <?php if ($progr<0.10)
{?> <img src="images/progression/5%25.png"></p><?php } else{ if ($progr<0.40){
    ?><img src="images/progression/25%25.png"><?php } else { if ($progr<0.65){
    ?><img src="images/progression/50%25.png"><?php } else { if ($progr<0.95){
    ?><img src="images/progression/75%25.png"><?php } else { ?><img src="images/progression/100%25.PNG"><?php
    
}}}}
         ?>   
        <hr>

        <div>
            <h3>Mes derniers badges</h3>
            <?php
            AfficherbadgeProfil($_SESSION['id'], 100);
            afficheSuccesProfil(($_SESSION['id']));
            ?>
        </div>
        <div class="div1">
            <h3>Mon meilleur score</h3>
            <h4>1000</h4>
        </div>
        </section>
        
    </div>
    <?php require_once "includes/scripts.php"; ?>
</body>
    <?php require_once "includes/footer.php"; ?>
</html>       