<html>
<?php
    session_start();
    $title = " - Confirmation de création d'annonce";
    require_once("includes/head.php");
    require_once("includes/functions.php");
    $code = $_GET['code'];

    //Récuperer le fichier s'il y en a un
    if (isset($_FILES['File'])) {

        $erreur = true;
        $file_name = $_FILES['File']['name'];
        $file_size = $_FILES['File']['size'];
        $file_tmp = $_FILES['File']['tmp_name'];
        $file_type = $_FILES['File']['type'];
        $extension = strrchr($_FILES['File']['name'], '.');//connaître l'extension du fichier
        $expensions = array(".pdf");
        
        if (in_array($extension, $expensions) === false) {
            $erreur = FALSE;
        }

        if ($file_size > 2097152) {
            $erreur = FALSE;
        }

        if ($erreur == TRUE) {
            move_uploaded_file($file_tmp, "files/" . $code . ".pdf");
            $query = "UPDATE OFFER SET off_file = \"files/" . "$code" . ".pdf\" WHERE off_code=:code"; //on place le fichier dans le dossier file avec comme le $code
            $prepQuery = getDB()->prepare($query);                                                      //cela permet d'effacer le fichier précédent pour cette annonce
            $prepQuery->bindvalue('code', $code, PDO::PARAM_INT);
            $prepQuery->execute();
        }
    }
    ?>

    <body>
        <div id="wrap">
            <div class="container nav">
                <?php
                    require_once("includes/navbar.php");
                ?>
            </div>
            <?php
                if (isset($_FILES['File'])) {
                    if ($erreur == TRUE) {
                        echo'<div class="alert alert-success col-sm-11" role="alert">
                            <strong>Votre fichier a bien été enregistré</strong>
                            </div>';
                    } else {
                        echo'<div class="alert alert-danger col-sm-11" role="alert">
                            <strong>Votre fichier doit être un pdf de moins de 2Mo</strong>
                            </div>';
                    }
                }
                ?>

                <div class="container">
                    <h2 class="text-center">Confirmation de création</h2>
                    <div class="well">
                        <?php
                            if (!empty($error)) {
                                echo'<div class="alert alert-danger col-sm-11" role="alert">
                                    <strong>Erreur : ' . $error . '</strong>
                                    </div>';
                            }
                        ?>
                            <article>Félicitations ! Votre annonce a bien été crée.
                                <br/> Une fois qu'un administrateur l'aura validé les adhérents pourront la voir. Une semaine plus tard, tous les utilisateurs pourront la voir.
                                <br/> Votre code est le <b><?php echo $code; ?> </b> .
                                <br/> Gardez le précieusement, il vous permet de modifier votre annonce.
                                <div class="alert alert-info" role="alert"> Vous pouvez dès maintenant continuer votre navigation sur le
                                    <a href='index.php' class="alert-link">site</a>.
                                </div>
                                <br/>Vous pouvez aussi choisir de joindre un fichier pdf à votre annonce mais cette étape est facultative.
                                <br/>
                            </article>

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input type="file" name="File" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span>Ajouter Fichier (pdf et moins de 2Mo)</button>
                                </div>
                            </form>
                            <br/>
                    </div>
                </div>
        </div>
        <?php
            require_once("includes/footer.php");
            require_once("includes/libScripts.php");
            require_once("includes/scriptVerifCreationAnnonce.php");
        ?>
    </body>

</html>