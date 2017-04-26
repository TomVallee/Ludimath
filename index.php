<?php
require_once "includes/functions.php";
session_start();

// Retrieve all movies
$movies = getDb()->query('select * from movie order by mov_id desc'); 
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <div><h1 align="center"> Mission Hebdomadaire </h1></div>
        <hr>
        <p>Realiser 20 exercices sur les Complexes ; </p>
        <hr>
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
                <!-- Lien vers la classe, transmission de l'ID de la classe -->
                    <div class="col-sm-4 portfolio-item text-center">
                        <a href="#" class="portfolio-link" data-toggle="modal">  
                            <div class="containerImg">
                                <img src="images/fond.jpg" class="img-responsive">
                                <div class="captionImg">
                                    <p align="center">Exercice 1</p>
                                </div>
                            </div>
                        </a>
                    </div> 
                <div align="left">
                    <div class="col-sm-4 portfolio-item text-center">
                        <a href="#" class="portfolio-link" data-toggle="modal">  
                            <div class="containerImg">
                                <img src="images/fond1.jpg" class="img-responsive">
                                <div class="captionImg">
                                    <p align="left">Exercice 1</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        </section>
    </div>

    <?php require_once "includes/scripts.php"; ?>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>