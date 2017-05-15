<?php
require_once "includes/functions.php";
session_start();
$reqEqui1 = getDb()->prepare('SELECT * FROM equipe WHERE equipe_id=?');
$reqEqui1->execute(array(1));
$equi1 = $reqEqui1->fetch();

$reqEqui2 = getDb()->prepare('SELECT * FROM equipe WHERE equipe_id=?');
$reqEqui2->execute(array(2));
$equi2 = $reqEqui2->fetch();

$reqUser = getDb()->prepare('SELECT * FROM user WHERE utilisateur_id=?');
$reqUser->execute(array($_SESSION['id']));
$equipe = $reqUser->fetch();


$img = $equi1['equipe_score']/($equi1['equipe_score']+$equi2['equipe_score']);
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
            <h3> Progression des équipes : </h3>
            <?php if ($img<0.10)
{?> <img src="images/equipe/0%25.PNG"><?php } else{ if ($img<0.20){
    ?><img src="images/equipe/10%25.png"><?php } else { if ($img<0.30){
    ?><img src="images/equipe/20%25.png"><?php } else { if ($img<0.40){
    ?><img src="images/equipe/30%25.png"><?php } else { if ($img<0.50){
    ?><img src="images/equipe/40%25.png"><?php } else { if ($img<0.60){
    ?><img src="images/equipe/50%25.png"><?php } else { if ($img<0.70){
    ?><img src="images/equipe/60%25.png"><?php } else { if ($img<0.80){
    ?><img src="images/equipe/70%25.png"><?php } else { if ($img<0.90){
    ?><img src="images/equipe/80%25.png"><?php } else { if ($img>0.90){ 
    ?><img src="images/equipe/90%25.png"><?php } else { ?><img src="images/equipe/100%25.png"><?php
    
}}}}}}}}}}
         ?>   
            <center><table class="table table-hover" style="width:400px;">
                        <thead text-align="center">
                            <tr> 
                                 <th> Nom </th> 
                                 <th> Prénom </th> 
                                 <th> Niveau </th> 
                            </tr> 
                        </thead>
                        
                        <?php 
                        $utilisateur = getDb() ->prepare('SELECT * FROM user WHERE equipe_id=? ORDER BY utilisateur_nom');
                        $utilisateur->execute(array($equipe['equipe_id']));
                        while($tuple=$utilisateur->fetch())
                        {
                            ?>
                            <tr>
                                <td class='vert-align'><?= $tuple['utilisateur_nom']; ?></td>
                                <td class='vert-align'><?= $tuple['utilisateur_prenom']; ?></td>
                                <td class='vert-align'><?= $tuple['utilisateur_niveau']; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                </center>


        </section>
    </div>

    <?php require_once "includes/scripts.php"; ?>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>