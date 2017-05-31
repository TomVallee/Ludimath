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

                        <div class="well">
                            <center><h2>Contexte</h2></center>
                            <p>Au début de l'année, les étudiants qui arrivent à  l'ENSC ont des profils très variés et n'ont pas tous les mêmes compétences en mathématiques. C'est pourquoi un parcours différencié leur est proposé afin d'harmoniser les connaissances au sein d'une promotion et de pouvoir débuter les enseignements dans les meilleures conditions.</p>
                            <p>Au fil des années, Mme Coralie Eyraud-Dubois, responsable du parcours différencié, a reçu un certain nombre de retours sur cet outil de la part des étudiants, notamment sur l'interface pas toujours adaptée ni engageante. Notre objectif a donc été de développer un nouveau système, complétant l'existant, qui soit ludique afin d'optimiser l'expérience des étudiants participant au parcours différencié de mathématiques.
                            </p>
                        </div>
                        <div class="well">
                            <center><h2>Qu'est ce que c'est? </h2></center>
                            <p>La création d'un site web permettant de réaliser des exercices de mathématiques tout en y incluant des aspects ludifiants a pour but de permettre un meilleur apprentissage de la part des étudiants de l'ENSC ayant des difficultés en mathématiques au début de l'année. De plus, la ludification du parcours différencié de mathématiques augmente les interactions entre les étudiants; ainsi cela facilite l'integration des élèves au début de l'année et, augmente ainsi l'entente et le bien être de la promotion à venir.</p>
                        </div>
                        <div class="well">
                            <center><h2>Point environnemental</h2></center>
                            <p>Il est également à prendre en compte qu'augmenter la réalisation des exercices de mathématiques sur ordinateur permet de continuer le virage pris par l'Education Nationale dans la numérisation des outils pédagogiques, et ainsi diminuer la consommation de papier et donc l'impact écologique de l'enseignement supérieur.</p>
                        </div>
                    </div>
            </div>

            <?php require_once "includes/footer.php"; ?>
                <?php require_once "includes/scripts.php"; ?>

        </body>

    </html>