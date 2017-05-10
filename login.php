<?php
require_once "includes/functions.php";
session_start();

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $stmt = getDb()->prepare('select * from user where utilisateur_login=? and utilisateur_mdp=?');
    $stmt->execute(array($login, $password));
    if ($stmt->rowCount() == 1) {
        // Authentication successful
        $user = $stmt->fetch();
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $user['utilisateur_id'];
        redirect("accueil_rentre.php");
    }
    else {
        $error = "Utilisateur non reconnu";
    }
}
?>

<!doctype html>
<html>

<?php 
$pageTitle = "Connexion";
require_once "includes/head.php";
?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>

        <h2 class="text-center"><?= $pageTitle ?></h2>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $error ?>
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
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require_once "includes/footer.php"; ?>
    <?php require_once "includes/scripts.php"; ?>
</body>

</html>
<?php 
require("includes/head.php");
?>
<head>
</head>
<?php
// Vérification des identifiants
if (array_key_exists('login', $_POST)&& array_key_exists('mdp', $_POST))
{
    $login= $_POST['login'] ; 
    $mdp= $_POST['mdp'];
    if ($_POST['poste']=='eleve')
    {
        $MaRequete1='SELECT utilisateur_login, utilisateur_mdp FROM user' ;
        $monrs=getDb()->query($MaRequete1);
        if($tuple = $monrs->fetch())
        {
            if ($login==$tuple['utilisateur_login'] && $mdp==$tuple['utilisateur_mdp'])
            {
                ?>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
                <h1>"Vous etes connecté"</h1>
            }
            else
            {
                ?>
                <h1>"Vous vous etes trompé d'identifiant ou de mot de passe"</h1>
                <h1>"Vous vous etes trompé d'identifiant ou de mot de passe"</h1>
                <h1>"Vous vous etes trompé d'identifiant ou de mot de passe"</h1>
                <h1>"Vous vous etes trompé d'identifiant ou de mot de passe"</h1>
                <h1>"Vous vous etes trompé d'identifiant ou de mot de passe"</h1>
                <?php
            }
        }
    }
}
/*require("../../includes/footer.php");*/
?>

