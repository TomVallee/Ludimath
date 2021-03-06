<?php
require_once "includes/functions.php";
session_start();

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = sha1($password);

    $stmt = getDb()->prepare('select * from user where utilisateur_connec=? and utilisateur_mdp=?');
    $stmt->execute(array($login, $password));
    if ($stmt->rowCount() == 1) {
        // Authentication successful
        $user = $stmt->fetch();
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $user['utilisateur_id'];
        redirect("index.php");
    }
    else {
        $error = "Utilisateur non reconnu.";
    }
}
?>

    <!doctype html>
    <html>

    <?php 
        $title="Connexion";

    require_once "includes/head.php";
    ?>

        <body>
            <div class="container">
                <?php require_once "includes/header.php"; ?>

                    <h2 class="text-center"><?= $title ?></h2>

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger">
                            <strong>Erreur !</strong>
                            <?= $error ?>
                        </div>
                        <?php } ?>

                            <div class="well">
                                <form class="form-signin form-horizontal" role="form" action="login.php" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                                            <input type="text" name="login" class="form-control" placeholder="Entrez votre login" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                                            <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span>Se connecter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
            </div>
            <?php require_once "includes/footer.php"; ?>
                <?php require_once "includes/scripts.php"; ?>

        </body>