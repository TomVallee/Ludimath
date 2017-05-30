<?php
require_once "includes/functions.php";
session_start();
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['lName']) && isset($_POST['fName']))
{
    if($_POST['passwd']!=$_POST['passwordConf'])
    {
        $error="Les mots de passe ne correspondent pas.";
    }
    else
    {
        $connec=escape($_POST['login']);
        $passwd = escape($_POST['passwd']);
        $lName=escape($_POST['lName']);
        $fName=escape($_POST['fName']);

        //Enlever les accents
        $nom=$_POST['lName'];
        $nom = htmlentities($nom, ENT_NOQUOTES, 'utf-8');
        $nom = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $nom);
        $nom = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $nom);
        $nom = preg_replace('#&[^;]+;#', '', $nom);
        
        $prenom=$_POST['fName'];
        $prenom = htmlentities($prenom, ENT_NOQUOTES, 'utf-8');
        $prenom = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $prenom);
        $prenom = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $prenom);
        $prenom = preg_replace('#&[^;]+;#', '', $prenom);

        //Enlever les -
        $nom=str_replace('-',"",$nom);
        $prenom=str_replace('-',"",$prenom);

        //Minuscules
        $nom=strtolower($nom);
        $prenom=strtolower($prenom);

        $login=$prenom.$nom."ipbfr";
        $login=substr($login,0,22);
        
        //Test d'existence du login
        $query="SELECT * FROM user WHERE utilisateur_connec=?";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($connec));
        if($ligne=$prepQuery->fetch())
        {
            $error="Ce login existe déjà.";
        }
        else
        {
            

            //Nombre d'étudiants
            $query="SELECT utilisateur_id FROM user ORDER BY utilisateur_id DESC";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->execute();
            $dernierId=$prepQuery->fetch()['utilisateur_id'];
            $equipe=$dernierId%2 +1;


            $query="INSERT INTO USER VALUES(null,:lname,:fname,:login,:connec,:pass,0,1,0,:equipe,36)";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->bindValue('lname',$lName,PDO::PARAM_STR);
            $prepQuery->bindValue('fname',$fName,PDO::PARAM_STR);
            $prepQuery->bindValue('login',$login,PDO::PARAM_STR);
            $prepQuery->bindValue('connec',$connec,PDO::PARAM_STR);
            $prepQuery->bindValue('pass',$passwd,PDO::PARAM_STR);
            $prepQuery->bindValue('equipe',$equipe,PDO::PARAM_INT);
            $prepQuery->execute();
            $_SESSION['create']=true;
            echo'<div class="alert alert-success col-sm-11">
                                    <strong>Compte créé avec succès.</strong>
                                </div>';
        }
    }
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
                                        <input type="text" class="form-control" name="login" placeholder="Choisissez votre login" value="<?php if(isset($error))echo $connec;?>" required autofocus>
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
                                    <label class="col-sm-4 control-label" for="passwd">Mot de passe* : </label>
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