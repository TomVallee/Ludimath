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
            <div>
                <h1 align="center"> Profil </h1></div>
            <h2><?php echo $nom.' '.$prenom;?></h2>
            <hr>
            <?php afficherTop(0);?>
            <section class="sec3">
                <?php
                $query="select utilisateur_experience FROM user WHERE utilisateur_id=?";
                $prepQuery=getDb()->prepare($query);
                $prepQuery->execute(array($_SESSION['id']));
                $exp=$prepQuery->fetch()['utilisateur_experience'];

                $query="select utilisateur_niveau FROM user WHERE utilisateur_id=?";
                $prepQuery=getDb()->prepare($query);
                $prepQuery->execute(array($_SESSION['id']));
                $niveau=$prepQuery->fetch()['utilisateur_niveau'];

                $query="select niveau_experience FROM niveau WHERE niveau_id=?";
                $prepQuery=getDb()->prepare($query);
                $prepQuery->execute(array($niveau));
                $expSuiv=$prepQuery->fetch()['niveau_experience'];
                ?>
                <p style="text-align:center">Experience (
                    <?php echo $exp.'/'.$expSuiv;?>) :
                    <?php if ($progr<0.10)
{?> <img src="images/progression/5%25.png"></p>
                <?php } else{ if ($progr<0.40){
                ?><img src="images/progression/25%25.png">
                <?php } else { if ($progr<0.65){
                ?><img src="images/progression/50%25.png">
                <?php } else { if ($progr<0.95){
                ?><img src="images/progression/75%25.png">
                <?php } else { ?><img src="images/progression/100%25.PNG">
                <?php

}}}}
                ?>


                <div>
                    <h3>Mes derniers succès</h3>
                    <?php
                    $query="SELECT succes_id FROM reussisucces WHERE utilisateur_id=? ORDER BY reussite_date DESC";
                    $prepQuery=getDB()->prepare($query);
                    $prepQuery->execute(array($_SESSION['id']));

                    for($i=0;$i<3;$i++)
                    {
                        if($succes=$prepQuery->fetch())
                        {
                            AfficherbadgeProfil($succes['succes_id'], 100);
                        }
                    }

                    ?>
                </div>

            </section>

        </div>
        <?php require_once "includes/scripts.php"; ?>
    </body>
    <?php require_once "includes/footer.php"; ?>

</html>