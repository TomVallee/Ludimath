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
       
        
    </div>
    </body>
        
<?php require_once "includes/scripts.php"; ?>
</html>