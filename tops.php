<?php

require_once "includes/functions.php";
session_start();
?>

<!doctype html>
<html>

    <?php require_once "includes/head.php"; ?>

    <body>
        <div id="wrap">
            <div class="container">
                <?php require_once "includes/header.php";  
                ?>
                <center><h2>Les tops</h2></center>
                <hr>
                <div class="well">
                    <div class="col1">
                        <?php afficherTop(0);?>
                    </div>
                    <div class="col2">
                        <?php afficherTop(1);?>
                    </div>
                    <div class="col3">
                        <?php afficherTop(2);?>
                    </div>
                    <div class="col1">
                        <?php afficherTop(3);?>
                    </div>
                    <div class="col2">
                        <?php afficherTop(4);?>
                    </div>
                    <div class="col3">
                        <?php afficherTop(5);?>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php 
    require_once "includes/scripts.php"; 
    require_once "includes/footer.php";
    ?>

</html>