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
    
    $files=scandir("resultats/");
    echo isZip($files[2]);
    $files=array_filter($files, "isZip");
    print_r($files);
    echo reset($files);
    $sauvegarde=reset($files);
    $zip=new ZipArchive;
    if ($zip->open("resultats/".$sauvegarde) === TRUE) {
            $zip->extractTo('resultats');
            $zip->close();
            echo 'ok';
            unlink("resultats/".$sauvegarde);
            $param=glob("resultats/class/*");
            print_r($param);
            foreach ($param as $filename) {
                if (is_file($filename)) {
                    unlink($filename);
                }
                else if (is_dir($filename) && $filename!="resultats/class/score")
                {
                    recursiveRemoveDirectory($filename);
                }
            }
            $param=glob("resultats/class/.*");
            print_r($param);
            unset($param[0]);
            unset($param[1]);
            print_r($param);
            foreach ($param as $filename) {
                if (is_file($filename)) {
                    unlink($filename);
                }
                else if (is_dir($filename) && $filename!="resultats/class/score")
                {
                    recursiveRemoveDirectory($filename);
                }
            }
        } else {
            echo 'échec';
        }
}

?>