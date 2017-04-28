<?php
require_once "includes/functions.php";
session_start(); 
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
        <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div><h1 align="center"> Mission Hebdomadaire</h1>
            
        <hr>
        <p>Realiser 20 exercices sur les Complexes :  <img src="images/progression/progression.png"></p> 
        <hr>
        </div>
    <nav> 
        <p>Classement général: </p>
            <ul>
            <li> Tom Vallée </li>
            <li> Tom Vallée </li>
            <li> Tom Vallée </li>
            <li> Tom Vallée </li>
            <li> Tom Vallée </li>
        </ul>
    </nav> 
    <section> 
            <div>
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="accueil_rentre.php">Test de rentrée</a></li>
                        <li role="presentation"><a href="accueil_premier.php">Premier Test</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Continuité et limites</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Suites</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Integration</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Matrice</a></li>
                        <li role="presentation"><a href="accueil_rentre.php">Test de fin</a></li>
                    </ul>

                <div>
                <!-- Lien vers la classe, transmission de l'ID de la classe -->
                    <div class="col-sm-4 portfolio-item text-center"> 
                        <a href="#">
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span> Exercice 1 </button>
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item text-center"> 
                        <a href="#">
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> Exercice 2 </button>
                        </a>
                    </div> 
                  
            </div>
        </div>
        </section>
    </div>
    <?php require_once "includes/scripts.php"; ?>
    <?php require_once "includes/footer.php"; ?>
</body>
</html>