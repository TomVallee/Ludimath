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
        <img alt="logo" src="/Ludimath/images/ludimath.png">
    </div>
    <section class="sec3">
    <p>Au début de l’année, les étudiants qui arrivent à l’ENSC ont des profils très variés et n’ont pas tous les mêmes compétences en mathématiques. C’est pourquoi un parcours différencié leur est proposé afin d’harmoniser les connaissances au sein d’une promotion et de pouvoir débuter les enseignements dans les meilleures conditions.
Ce parcours s’effectue sur un outil numérique interactif que nous décrirons plus loin dans ce document.
Au fil des années, Mme Coralie Eyraud-Dubois, responsable du parcours différencié, a reçu un certain nombre de feedbacks sur cet outil de la part des étudiants, notamment sur l’interface pas toujours adaptée ni engageante.
Notre objectif est donc de développer un nouveau système, basé sur l’existant, qui soit exempt de problèmes logiciels, notamment d’interface, et qui soit ludique afin d’optimiser l’expérience des étudiants participant au parcours différencié de mathématiques.
</p>
    </section>
    <?php require_once "includes/scripts.php"; ?>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>