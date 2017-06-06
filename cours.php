<?php
require_once "includes/functions.php";
session_start();
?>

    <!doctype html>
    <html>
    <?php $title="Cours";?>

        <?php require_once "includes/head.php"; ?>

            <body>
                <div id="wrap">
                    <div class="container nav">
                        <?php require_once "includes/header.php"; ?>
                    </div>
                    <div class="container">
                        <center>
                            <h2>Les cours</h2></center>
                        <hr>
                        <div class="well">
                            Vous pouvez ici télécharger les cours correspondant aux thèmes abordés dans le parcours différencié.
                            <br/> Ceux-ci peuvent être aussi lus sur WIMS.
                            <br/>
                            <br/>
                            <ul>
                                <li><a href="cours/Fonctions.pdf">Fonctions</a></li>
                                <li><a href="cours/Suites.pdf">Suites</a></li>
                                <li><a href="cours/Complexes.pdf">Nombres complexes</a></li>
                                <li><a href="cours/Matrices.pdf">Matrices</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php require_once "includes/footer.php"; ?>
                    <?php require_once "includes/scripts.php"; ?>
            </body>

    </html>