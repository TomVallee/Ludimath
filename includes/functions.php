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

//dit si l'user a réussi le succès
function aSucces($succesId,$userId){
    $prepQuery="SELECT count(*) from reussisucces WHERE utilisateur_id = ".$userId." and succes_id=".$succesId;
        $res= getDb()->query($prepQuery);        
            $count=$res->fetch(); 
        return $count['count(*)'];
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
    
        echo'<div class="succes">';
    echo"
    <div class ='row'><a href='changerbadge.php?badge=".$id."'>
    <img src='images/badges/".$badge."' height='70' width='70' ></a>
    <strong>".$titre."</strong></br>
    </div>
    <div class='row'>".$cond."</div>";             
        echo'</div>';
}
//affiche un succes non obtenu
function afficheContenuSuccesNonObtenu($id)
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
    
        echo'<div class="successombre"> ';
    echo"
    <div class ='row'>
    <img src='images/badges/".$badge."' height='70' width='70' >
    <strong>".$titre."</strong></br>
    </div>
    <div class='row'>".$cond."</div>";   
    echo'</div>';
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
        afficheContenuSuccesNonObtenu($id); 
    }    
}

//affiche les succes du joueur
function afficheSucces($utilisateur_id){
    $query ="Select succes_id from reussisucces where utilisateur_id=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));
    
    foreach($prepQuery as $id){
        afficheContenuSucces($id['succes_id']); 
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

//Changer le badge de l'utilisateur
function changerbadge($badgeid,$id){
     
    $query = "Select utilisateur_id from user where utilisateur_login=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($id));
    $userid=$prepQuery->fetch();
    $userid=$userid['utilisateur_id'];
    if(asucces($badgeid,$userid)!=0){
        echo"oui.";
    $query="UPDATE user SET badge_id = :badge WHERE utilisateur_id = :user";
    $prepQuery = getDB()->prepare($query);
    $prepQuery->bindValue('badge', $badgeid, PDO::PARAM_INT);
    $prepQuery->bindValue('user', $userid, PDO::PARAM_INT);
    
        $prepQuery->execute();
        redirect("succes.php");
    }
    else
    {
        echo"non.";
        redirect("succes.php");
    }
}
//AfficherBadgede l'utilisateur
function Afficherbadge($utilisateurId,$taille)
{
    
    $query="SELECT badge_id FROM user WHERE utilisateur_id=?";    
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateurId));
    $res=$prepQuery->fetch();    
    $badgeId=$res['badge_id'];
    
    $query="SELECT * FROM badge WHERE badge_id=?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($badgeId));
    $res=$prepQuery->fetch();
    $badge=$res['badge_icone'];
    
    echo"<img src='images/badges/".$badge."' height=".$taille."width=".$taille." >";
    
}
//MAJ du top $id
function majTop($id)
{
    $top=array();
    $query="SELECT utilisateur_id, sum(note_score) from notes ";
    if($id!=0)
    {
        $query.="where exercice_id in (select exercice_id from exercice where feuille_id in (select feuille_id from feuille where theme_id = ?))";
    }
    $query.=" group by utilisateur_id";
    echo $query;
    $prepQuery=getDb()->prepare($query);
    if($id==0)
        $prepQuery->execute();
    else
        $prepQuery->execute(array($id));
    while($result=$prepQuery->fetch())
    {
        $top[$result["utilisateur_id"]]=$result["sum(note_score)"];
    }
    print_r($top);
    $top=array_slice($top,0,5,$preserve_keys=TRUE);
    asort($top);
    $keys=array_keys($top);
    $maxKey=max(array_keys($keys));
    $query="UPDATE top SET top_pre=:prem, top_deux=:deux, top_trois=:trois, top_quat=:quatre, top_cinq=:cinq WHERE top_id=:id";
    $prepQuery=getDb()->prepare($query);
    if($maxKey>=0)
        $prepQuery->bindValue("prem",$keys[$maxKey]);
    else
        $prepQuery->bindValue("prem",null);
    if($maxKey>=1)
        $prepQuery->bindValue("deux",$keys[$maxKey-1]);
    else
        $prepQuery->bindValue("deux",null);
    if($maxKey>=2)
        $prepQuery->bindValue("trois",$keys[$maxKey-2]);
    else
        $prepQuery->bindValue("trois",null);
    if($maxKey>=3)
        $prepQuery->bindValue("quatre",$keys[$maxKey-3]);
    else
        $prepQuery->bindValue("quatre",null);
    if($maxKey==4)
        $prepQuery->bindValue("cinq",$keys[$maxKey-4]);
    else
        $prepQuery->bindValue("cinq",null);
    $prepQuery->bindValue("id",$id);
    $prepQuery->execute();
}

//MAJ d'un top en particulier
/*function majTop($id)
{
    $query="select utilisateur_id, sum(note_score) from notes where exercice_id in (select exercice_id from exercice where feuille_id in (select feuille_id from feuille where theme_id = ?)) group by utilisateur_id";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute($id);
    
    $top=array();
    
    
}*/