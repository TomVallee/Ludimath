<?php
require_once "includes/functions.php";
session_start();
?>

    <!doctype html>
    <html>

    <?php require_once "includes/head.php"; ?>

        <body>
            <div id="wrap">
                <div class="container nav">
                    <?php require_once "includes/header.php"; ?>
                </div>
                <?php
                    require_once "includes/afficheSucces.php";
                ?>
                    <div class="container">
                        <center><img alt="logo" src="images/ludimath.png"></center>

                        <div class="well" style="margin-bottom: 500px;">
                            <center><h1>Présentation</h1></center>
                            <h3><b>Sujet :</b> Rendre le parcours différencié de mathématiques plus  attractif à l’aide d’outil de ludification en utilisant comme support le site WIMS</h3>
                            <h3><b>Objectif :</b> Créer une nouvelle plate-forme éducative ludique</h3>                            
                        </div>
                        <div class="well">
                            <center><h1>Matrice des risques</h1></center>
                            <center><img alt="logo" src="images/matriceRisques.png"></center>
                        </div>
                    </div>
            </div>

            <?php require_once "includes/footer.php"; ?>
                <?php require_once "includes/scripts.php"; ?>

        </body>

    </html>

