<?php
require_once "includes/functions.php";
session_start();
?>
    <!doctype html>
    <html>

    <body>
        <?php require_once "includes/head.php"; ?>
            <div class="container">
                <?php require_once "includes/header.php"; ?>
            </div>


            <?php

if (isset($_POST['raz']))
{
    ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">Confirmer ?</div>
                        <div class="col-sm-4">
                            <button type="submit" name="valid" value="true" class="btn btn-primary"><span class='glyphicon glyphicon-ok'></span>Oui</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" name="valid" value="false" class="btn btn-primary"><span class='glyphicon glyphicon-remove'></span>Non</button>
                        </div>
                    </div>
                </form>
                <?php
}

else{
    if(isset($_FILES['File']))
{
    //Enregistrement du fichier
     $erreur = true;
     $file_name = $_FILES['File']['name'];
     $file_size = $_FILES['File']['size'];
     $file_tmp = $_FILES['File']['tmp_name'];
     $file_type = $_FILES['File']['type'];
     $extension = strrchr($_FILES['File']['name'], '.');//connaître l'extension du fichier
     $expensions = array(".zip");
        
     if (in_array($extension, $expensions) === false) {
         $erreur = FALSE;
     }
     if ($erreur == TRUE) {
         move_uploaded_file($file_tmp, "resultats/" . $file_name);
    }
    
    //Dézippage du fichier
    $sauvegarde=glob("resultats/*.zip");
    $zip=new ZipArchive;
    if(!empty($sauvegarde))
    {
        $sauvegarde=$sauvegarde[0];
            if ($zip->open($sauvegarde) === TRUE) {
                    $zip->extractTo('resultats');
                    $zip->close();
                //Suppression du zip
                    unlink($sauvegarde);
                //Suppression de tous les fichiers/dossiers inutiles
                    $param=glob("resultats/class/*");
                    foreach ($param as $filename) {
                        if (is_file($filename)) {
                            unlink($filename);
                        }
                        else if (is_dir($filename) && $filename!="resultats/class/score")
                        {
                            recursiveRemoveDirectory($filename);
                        }
                    }
                //Suppression de tous les fichiers/dossiers inutiles en .xxx
                    $param=glob("resultats/class/.*");
                    unset($param[0],$param[1]);
                    foreach ($param as $filename) {
                        if (is_file($filename)) {
                            unlink($filename);
                        }
                        else if (is_dir($filename) && $filename!="resultats/class/score")
                        {
                            recursiveRemoveDirectory($filename);
                        }
                    }
                    unlink("resultats/class/score/supervisor");
                    $bin=glob("resultats/class/score/*.bin");
                    foreach($bin as $filename)
                    {
                        unlink($filename);
                    }
                    $eleves=glob("resultats/class/score/*");
                    foreach($eleves as $eleve)
                    {
                        $resultats=file($eleve);
                        $file=explode("/",$eleve);
                        $login=end($file);
                        $query="SELECT utilisateur_id FROM user WHERE utilisateur_login=?";
                        $prepQuery=getDb()->prepare($query);
                        $prepQuery->execute(array($login));
                        if($etudId=$prepQuery->fetch()["utilisateur_id"])
                        {
                            $query="SELECT * FROM notes WHERE utilisateur_id=? ORDER BY note_date DESC";
                            $prepQuery=getDb()->prepare($query);
                            $prepQuery->execute(array($etudId));
                            if($res=$prepQuery->fetch()){
                                $dernierExo=str_replace("-","",$res['note_date']);
                                $dernierExo=str_replace(" ","",$dernierExo);
                                $dernierExo=str_replace(":","",$dernierExo);
                            }
                            else{
                                $dernierExo=0;
                            }
                            $size=count($resultats);
                            for($i=0;$i<$size;$i++)
                            {
                                $datetime=explode(" ",$resultats[$i])[0];
                                $datetime=str_replace(".","",$datetime);
                                $datetime=str_replace(":","",$datetime);
                                if(floatval($datetime)<=$dernierExo)
                                {
                                    unset($resultats[$i]);
                                }
                            }
                            foreach($resultats as $ligne)
                            {
                                $ligne=preg_replace('/\s+/', ' ',$ligne);
                                $content=explode(" ",$ligne);
                                $datetime=$content[0];
                                $datetime=str_replace("."," ",$datetime);
                                $datetime=str_replace(substr($datetime,0,6),substr($datetime,0,6)."-",$datetime);
                                $datetime=str_replace(substr($datetime,0,4),substr($datetime,0,4)."-",$datetime);
                                $sheet=$content[2];
                                $exo=$content[3];
                                $type=$content[4];
                                if($type=="score" && in_array($sheet,array(1,2,3,4,5,6,7,9,10,11,13)))
                                {
                                    $score=$content[5];
                                    $query="SELECT exercice_id FROM exercice WHERE feuille_id=? AND exercice_num=?";
                                    $prepQuery=getDb()->prepare($query);
                                    $prepQuery->execute(array($sheet,$exo));
                                    $exoId=$prepQuery->fetch()["exercice_id"];


                                    $query="INSERT INTO notes VALUES (null,:date,:score,:idexo,:iduser)";
                                    $prepQuery=getDb()->prepare($query);
                                    $prepQuery->bindValue("date",$datetime);
                                    $prepQuery->bindValue("score",$score);
                                    $prepQuery->bindValue("idexo",$exoId);
                                    $prepQuery->bindValue("iduser",$etudId);
                                    $prepQuery->execute();
                                }
                            }
                            //Maj de l'exp et des niveaux
                            majExp($etudId);
                            majNiveau($etudId);
                        }
                    }

                    //MAJ Tops
                    for($i=0;$i<7;$i++)
                        majTop($i);
                    //Maj score équipes
                        majEquipes();
                    foreach($eleves as $eleve)
                    {
                        $resultats=file($eleve);
                        $file=explode("/",$eleve);
                        $login=end($file);
                        $query="SELECT utilisateur_id FROM user WHERE utilisateur_login=?";
                        $prepQuery=getDb()->prepare($query);
                        $prepQuery->execute(array($login));
                        if($etudId=$prepQuery->fetch()["utilisateur_id"])
                        {
                            //Maj succès
                            majSucces($etudId);
                        }
                    }
                    echo "<div class='container'>";
                    echo "<div class='alert alert-success'>Mise à jour réussie.</div>";
                    echo "</div>";
                } else {
                    echo 'échec';
                }
    }
}
    else if(isset($_POST['valid']) && $_POST['valid']=="true")
    {
            //supression des résultats
            $prepQuery=getDb()->prepare("DELETE FROM notes");
            $prepQuery->execute();
            
            //MAJ des tops
            for($i=0;$i<=6;$i++)
                majTop($i);
            //suppression des succès réussis
            $prepQuery=getDb()->prepare("DELETE FROM reussisucces");
            $prepQuery->execute();
            
            //suppression des étudiants
            $prepQuery=getDb()->prepare("DELETE FROM user WHERE utilisateur_admin=0");
            $prepQuery->execute();
            
            //Raz des scores d'équipes
            $prepQuery=getDb()->prepare("UPDATE equipe SET equipe_score=0");
            $prepQuery->execute();
        
        echo "<div class='container'>";
        echo "<div class='alert alert-success'>Remise à zéro réussie.</div>";
        echo "</div>";
    }
?>


                    <div class="container">
                        <div class="well">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input type="file" name="File" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span>Mettre à jour le parcours</button>
                                </div>
                            </form>
                        </div>
                        <div class="well">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="col-sm-4">
                                    <button type="submit" name="raz" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span>Remettre à zéro le parcours</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>

                        <?php require_once "includes/scripts.php"; ?>
                            <?php require_once "includes/footer.php"; ?>
    </body>

    </html>