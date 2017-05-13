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
        <div><h1 align="center"> Ludimath</h1></div>
        <hr>
        <div class="div2"> 
        <h4>Classement Limite et Continuité: </h4>
            <ul>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_pre` FROM `top` WHERE `top_id` =1)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_deux` FROM `top` WHERE `top_id` =1)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_trois` FROM `top` WHERE `top_id` =1)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_quat` FROM `top` WHERE `top_id` =1)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
            <li> <?php 
                $top = getDb() ->query('SELECT utilisateur_nom, utilisateur_prenom FROM user WHERE utilisateur_id = (SELECT `top_cinq` FROM `top` WHERE `top_id` =1)');
                $top=$top->fetch(); 
                echo $top['utilisateur_nom'].' '.$top['utilisateur_prenom'];
                ?></li>
        </ul>
        </div> 
        <section class="sec3"> 
            <div class="">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="accueil_rentre.php">Test de rentrée</a></li>
                        <li role="presentation"><a href="accueil_premier.php">Premier Test</a></li>
                        <li role="presentation" class="active"><a href="accueil_limite.php">Continuité et limites</a></li>
                        <li role="presentation"><a href="accueil_limite.php">Suites</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Integration</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Matrice</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Test de fin</a></li>
                    </ul>
                </div>
                <!-- Lien vers la classe, transmission de l'ID de la classe -->
                    <div class="div1"> 
                        <a href="#">
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span> Exercice 1 </button>
                        </a>
                    </div>
                    <div class="div1"> 
                        <a href="#">
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> Exercice 2 </button>
                        </a>
                    </div> 
                    <div class="div1"> 
                        <a href="#">
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> Exercice 3 </button>
                        </a>
                    </div> 
                    <div class="div1"> 
                        <a href="#">
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> Exercice 4 </button>
                        </a>
                    </div> 
        </section>
    </div>

    <?php require_once "includes/scripts.php"; ?>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>