<?php
require_once "includes/functions.php";
session_start();
$query= getDb()->query("SELECT succes_id FROM succes");
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        Voici votre badge : 
            <?php
            Afficherbadge($_SESSION['id'], 100);
            afficheSucces(($_SESSION['id']));
        
        ?>
    </div>
</body>
        
<?php require_once "includes/scripts.php"; ?>
</html>