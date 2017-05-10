<?php
require_once "includes/functions.php";
session_start();
if (isset($_Post['login']) && isset($_Post['passwd']) && isset($_POST['lName']) && isset($_POST['fName']))
{
    $login =escape($_Post['login']);
    $passwd = escape($_Post['passwd']);
    $lName=escape($_POST['lName']);
    $fName=escape($_POST['fName']);
    
    $query="INSERT INTO USER VALUES(null,:lname,:fname,:login,:pass,0,1,1)";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->bindValue('lname',$lName,PDO::PARAM_STR);
    $prepQuery->bindValue('lname',$lName,PDO::PARAM_STR);
    $prepQuery->bindValue('login',$login,PDO::PARAM_STR);
    $prepQuery->bindValue('passwd',$passwd,PDO::PARAM_STR);                    
    $prepQuery->execute();
    $_SESSION['create']=true;
    echo'<div class="alert alert-danger col-sm-11">
                            <strong>Bienvenue</strong>
                        </div>';
}
    
    ?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        
                <h2 class="text-center">Création d'un compte</h2>
                <div class="well">
                    <?php if(!empty($error)){
                        echo'<div class="alert alert-danger col-sm-11">
                            <strong>Erreur : '.$error.'</strong>
                        </div>';
                    }?>
                        <form class="form-horizontal" method="post" action="creation_compte.php">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="login">Login* : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="login" placeholder="Choisissez votre login" value="<?php if(isset($error))echo $login;?>" required autofocus>
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="lName">Nom* : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lName" placeholder="Nom" value="<?php if(isset($error))echo $lName;?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="fName">Prénom* : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fName" placeholder="Prénom" value="<?php if(isset($error))echo $fName;?>" required>
                                </div>                            
                            </div>
                            <div class="form-group" id="formGroupPasswd">
                                <label class="col-sm-4 control-label" for="passwd">Mot de passe (Au moins 8 caractères dont un chiffre et une lettre)* : </label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Choisissez un mot de passe" required>
                                </div>
                            </div>
                            <div class="form-group" id="formGroupPasswdConf">
                                <label class="col-sm-4 control-label" for="passwdConf">Confirmez votre mot de passe* : </label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="passwordConf" name="passwordConf" placeholder="Confirmez votre mot de passe" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span>Créer un compte</button>
                                </div>
                            </div>
                        </form>
                </div>
           
    </div>
</body>
        
<?php require_once "includes/scripts.php"; ?>
</html>