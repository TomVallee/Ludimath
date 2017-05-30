<?php

require_once "includes/functions.php";
session_start();

if (isset($_GET['theme'] )){
$theme=$_GET['theme']; 
}
else 
{
    redirect('exercices.php?theme=1');
}
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php";  
        AfficherTop($theme);
        Affichertop(0);?>
        
       <ul class="nav nav-tabs">
           <?php
           $query = "SELECT * FROM theme Order By theme_id";
           $table_theme= getDB()->query($query);
           while ($tuple = $table_theme->fetch()) {
               if (isset($_GET['theme']) && $tuple['theme_id'] == $_GET['theme']) {
                   echo'<li role="presentation" class="active"><a href="exercices.php?theme='.$tuple['theme_id'].'">'.$tuple['theme_titre'].'</a></li>';
                   } 
                   else {
                       echo'<li role="presentation"><a href="exercices.php?theme='.$tuple['theme_id'].'">'.$tuple['theme_titre'].'</a></li>';                   
                       }
                   }
             ?>
        </ul>
        <?php
        $query = "SELECT * FROM feuille Where theme_id=?";                
        $prepQuery=getDB()->prepare($query);    
        $prepQuery->execute(array($theme));    
        $feuilles=$prepQuery->fetch();
            foreach($prepQuery as $id){
               echo'<div>';
               echo$id['feuille_titre'];
               echo'</div>';
               }
        ?>
    </div>
    </body>
        
    <?php require_once "includes/scripts.php"; ?>
    <?php require_once "includes/footer.php"; ?>
</html>