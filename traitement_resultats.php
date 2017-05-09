<?php
require_once "includes/functions.php";
session_start();


if(!isset($_FILES['File']))
{
    echo' <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input type="file" name="File" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary"><span class=\'glyphicon glyphicon-save\'></span>Ajouter Fichier (pdf et moins de 2Mo)</button>
                                </div>
                            </form>';
}
else
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
    $sauvegarde=glob("resultats/*.zip")[0];
    $zip=new ZipArchive;
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
                echo $login."<br/>";
                $query="SELECT utilisateur_id FROM user WHERE utilisateur_login=?";
                $prepQuery=getDb()->prepare($query);
                $prepQuery->execute(array($login));
                $id=$prepQuery->fetch()["utilisateur_id"];
                $query="SELECT * FROM notes WHERE utilisateur_id=? ORDER BY note_date DESC";
                $prepQuery=getDb()->prepare($query);
                $prepQuery->execute(array($id));
                if($res=$prepQuery->fetch()){
                    $dernierExo=str_replace("-","",$res['note_date']);
                }
                else{
                    $dernierExo=00000000;
                }
                echo $dernierExo."<br/>";
                $size=count($resultats);
                for($i=0;$i<$size;$i++)
                {
                    $date=explode(" ",$resultats[$i])[0];
                    $date=substr($date,0,4).substr($date,4,2).substr($date,6,2);
                    if(intval($date)<=$dernierExo)
                    {
                        unset($resultats[$i]);
                    }
                }
                foreach($resultats as $ligne)
                {
                    $ligne=preg_replace('/\s+/', ' ',$ligne);
                    $content=explode(" ",$ligne);
                    $date=$content[0];
                    $sheet=$content[2];
                    $exo=$content[3];
                    $type=$content[4];
                    if($type=="score")
                    {
                        $score=$content[5];
                    }
                    echo "$date - $sheet - $exo - $type";
                    if($type=="score")
                    {
                        echo " - $score";
                    }
                    echo "<br/>";
                }
                echo "<br/>";
            }
        } else {
            echo 'échec';
        }
}

?>