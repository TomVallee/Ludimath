<?php

// Connect to the database. Returns a PDO object
function getDb() {
    // Local deployment
    $server = "localhost";
    $username = "ludimath_user";
    $password = "passwd";
    $db = "ludimath";

    // Deployment on Heroku with ClearDB for MySQL
    /*$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);*/
    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Check if a user is connected
function isUserConnected() {
    return isset($_SESSION['login']);
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
}

// Escape a value to prevent XSS attacks
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}
//affiche le contenu d'un succes
function afficheContenuSucces($id)
{    
    $query="SELECT * FROM succes WHERE succes_id=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($id));
    $res=$prepQuery->fetch();
    $titre=$res['succes_titre'];
    $cond=$res['succes_cond'];
    $query="SELECT * FROM badge WHERE badge_id=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($id));
    $res=$prepQuery->fetch();
    $badge=$res['badge_icone'];
    echo"
    <div class ='row'>
    <img src='images/badges/".$badge."' height='70' width='70' >
    <strong>".$titre."</strong></br>
    </div>
    <div class='row'>".$cond."</div>";   
}

//affiche les succes non obtenus et cachés
function afficheSuccesNonObtenu($id){
    $query="SELECT * FROM succes WHERE succes_id=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($id));
    $res=$prepQuery->fetch();
    $titre=$res['succes_titre'];
    $cond=$res['succes_cond'];
    $cache=$res['succes_cache'];
    if($cache)
    {
        echo'<div class="successombre"> ';
        echo"
        <div class ='row'>
        <img src='images/badges/secret.png' height='70' width='70' >
        <strong>".$titre."</strong></br>
        </div>
        <div class='row'>Ce succès est secret</div>";   
        echo'</div>';
    }
    else{
        echo'<div class="successombre"> ';
        afficheContenuSucces($id);        
        echo'</div>';
    }    
}

//affiche les succes du joueur
function afficheSucces($utilisateur_id){
    $query ="Select succes_id from reussisucces where utilisateur_id=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));
    
    foreach($prepQuery as $id){
        echo'<div class="succes"> ';
        afficheContenuSucces($id['succes_id']);        
        echo'</div>';
        echo'</br>';
        }
        
    $query ="SELECT succes_id,succes_cache FROM succes WHERE succes_id NOT IN (SELECT succes_id from reussisucces where utilisateur_id=1) Order By succes_cache";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));
    foreach($prepQuery as $id){
        afficheSuccesNonObtenu($id['succes_id']);  
        echo'</br>';
        }
    
}

//Supprimer un dossier et son contenu
function recursiveRemoveDirectory($directory)
{
    //print_r(glob("{$directory}/*"));
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    $glob=glob("{$directory}/.*");
    unset($glob[0]);
    unset($glob[1]);
    foreach($glob as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}