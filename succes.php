<?php
require_once "includes/functions.php";
session_start();
$query= getDb()->query("SELECT succes_id FROM succes");
?>

    <!doctype html>
    <html>
    <?php $title="Succès";?>
        <?php require_once "includes/head.php"; ?>

            <body>
                <div class="container">
                    <?php require_once "includes/header.php"; ?>
                        <center>
                            <h2>Les succès</h2></center>
                        <hr>
                        <p>Voici votre badge :
                            <?php Afficherbadge($_SESSION['id'], 100);?>
                        </p>
                        <?php afficheSucces(($_SESSION['id']));

            ?>
                </div>
            </body>
            <?php require_once "includes/scripts.php"; ?>
                <?php require_once "includes/footer.php"; ?>


    </html>