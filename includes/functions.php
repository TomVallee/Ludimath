<?php

// Connect to the database. Returns a PDO object
function getDb() {
    // Local deployment
    $server = "localhost";
    $username = "ludimath_user";
    $password = "passwd";
    $db = "ludimath";

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

//Verifie les succes à afficher et les affiche
function AfficherNotifSucces($userId)
{
    
}

//SuccesConnexion
function SuccesConnection($userdId)
{
    $heure = date("G");
    $minute = date("i");
    if (11<$heure && $heure <14)
    {ReussirSucces(28,$userdId);}
    else if (20<$heure && $heure <=24)
    {ReussirSucces(29,$userId);}
    else if (5<$heure && $heure <9)
    {ReussirSucces(30,$userId);}
    else if (7<$heure && $heure <10)
    {ReussirSucces(31,$userId);}
    else if (2<$heure && $heure <4)
    {
        if(12<$minute && $minute<16)
            {ReussirSucces(32,$userId);}
    }
    if (aSucces(28,$userdId)!=0 && aSucces(29,$userdId)!=0 && aSucces(30,$userdId)!=0 && aSucces(31,$userdId)!=0 && aSucces(32,$userdId)!=0)
    {ReussirSucces(33,$userdId);}
}

//ReussirSucces
function ReussirSucces($succesId,$userId)
{
    if(aSucces($succesId,$userId)==0)
    {
        $query="INSERT INTO reussisucces VALUES (null,:date,1,:succes,:utilisateur)";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->bindValue("date",date("Y-m-d"));
        $prepQuery->bindValue("succes",$succesId);
        $prepQuery->bindValue("utilisateur",$userId);
        $prepQuery->execute();
    }
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

function afficheSuccesProfil($utilisateur_id){
    $query ="Select succes_id from reussisucces where utilisateur_id=? ORDER BY reussite_date limit 0,3";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));
    while($id=$prepQuery->fetch()){
        afficheContenuSucces($id['succes_id']); 
        $i=$i+1;
        echo'</br>';
        }
        
    /*$query ="SELECT succes_id,succes_cache FROM succes WHERE succes_id NOT IN (SELECT succes_id from reussisucces where utilisateur_id=1) Order By succes_cache";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));
    for($i=0; $i<3; $i=$i+1){
        afficheSuccesNonObtenu($id['succes_id']);  
        echo'</br>';
        }*/
    
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
//AfficherBadge de l'utilisateur
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
function AfficherBadgeId($badge_id,$taille)
{
    if ($badge_id!=""){
        $query="SELECT * FROM badge WHERE badge_id=?";
        $prepQuery=getDB()->prepare($query);
        $prepQuery->execute(array($badge_id));
        $res=$prepQuery->fetch();
        $badge=$res['badge_icone'];
    
        echo"<img src='images/badges/".$badge."' alt='".$badge."' height=".$taille."width=".$taille." >";
    }
    else {
        echo"<img src='images/badges/ludimath.png' height=".$taille."width=".$taille." >";
    }
    
}

function Afficherbadgeprofil($badge_id,$taille)
{
    
    if ($badge_id!=""){
        $query="SELECT * FROM badge WHERE badge_id=?";
        $prepQuery=getDB()->prepare($query);
        $prepQuery->execute(array($badge_id));
        $res=$prepQuery->fetch();
        $badge=$res['badge_icone'];
        echo"<img src='images/badges/".$badge."' alt='".$badge."' height=".$taille."width=".$taille." >";
    }
    else {
        echo"<img src='images/badges/ludimath.png' height=".$taille."width=".$taille." >";
    }
    
}


//Affiche le top sur la page en fonction de l'id du top
function AfficherTop($idTop)
{
    $query ="SELECT utilisateur_nom, utilisateur_prenom, badge_id FROM user "
            . "WHERE utilisateur_id = (SELECT `top_pre` FROM `top` WHERE `top_id` =?)";    
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($idTop));
    $pre=$prepQuery->fetch();
    
    $query ="SELECT utilisateur_nom, utilisateur_prenom, badge_id FROM user "
            . "WHERE utilisateur_id = (SELECT `top_deux` FROM `top` WHERE `top_id` =?)"; 
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($idTop));
    $deux=$prepQuery->fetch();
    
    $query ="SELECT utilisateur_nom, utilisateur_prenom, badge_id FROM user "
            . "WHERE utilisateur_id = (SELECT `top_trois` FROM `top` WHERE `top_id` =?)";    
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($idTop));
    $trois=$prepQuery->fetch();
    
    $query ="SELECT utilisateur_nom, utilisateur_prenom, badge_id FROM user "
            . "WHERE utilisateur_id = (SELECT `top_quat` FROM `top` WHERE `top_id` =?)";    
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($idTop));
    $quat=$prepQuery->fetch();
    
    $query ="SELECT utilisateur_nom, utilisateur_prenom, badge_id FROM user "
            . "WHERE utilisateur_id = (SELECT `top_cinq` FROM `top` WHERE `top_id` =?)";    
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($idTop));
    $cinq=$prepQuery->fetch();
    
    $query ="Select top_nom from top where top_id =?";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($idTop));
    $titre=$prepQuery->fetch();
    
    echo"<br/>";
    echo"<div class='div2'>";
    echo"<h4><center>".$titre['top_nom']."</center></h4>";
    
    echo "<ul>";
    if ($pre['utilisateur_nom']!=""){
        echo'<li>';echo"<strong> 1. ";
        AfficherBadgeId($pre['badge_id'], 18);echo" ";
        echo$pre['utilisateur_prenom']; echo" ";echo $pre['utilisateur_nom'];
        echo"</strong>";echo'</li>';
        if ($deux['utilisateur_nom']!="")
        {
            echo'<li>';echo"2. ";
            AfficherBadgeId($deux['badge_id'], 15);echo" ";
            echo$deux['utilisateur_prenom']; echo" ";echo $deux['utilisateur_nom'];
            echo'</li>';
            if ($trois['utilisateur_nom']!="")
            {
                echo'<li>';echo"3. ";
                AfficherBadgeId($trois['badge_id'], 15);echo" ";
                echo$trois['utilisateur_prenom']; echo" "; echo $trois['utilisateur_nom'];
                echo'</li>';        
                if ($quat['utilisateur_nom']!="")
                {
                    echo'<li>';echo"4. "; 
                    AfficherBadgeId($quat['badge_id'], 15);echo" ";
                    echo$quat['utilisateur_prenom']; echo" ";echo $quat['utilisateur_nom'];
                    echo'</li>';        
                    if ($cinq['utilisateur_nom']!="")
                    {
                        echo'<li>';echo"5. ";
                        AfficherBadgeId($cinq['badge_id'], 15);echo" ";
                        echo$cinq['utilisateur_prenom']; echo" ";echo $cinq['utilisateur_nom'];
                        echo'</li>';  
                    }
                    else
                    {
                        echo"Place à prendre";
                    }
                }
                else
                {
                    echo"Place à prendre";
                }
            }
            else
            {
                echo"Place à prendre";
            }
        }
        else
        {
            echo"Place à prendre";
        }
    }//reflechir aux noms trop grands
    else
    {
        echo"Place à prendre";
    }
    echo"</ul>";echo"</div>"; echo"<br/>";
    
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
    $prepQuery=getDb()->prepare($query);
    if($id==0)
        $prepQuery->execute();
    else
        $prepQuery->execute(array($id));
    while($result=$prepQuery->fetch())
    {
        $top[$result["utilisateur_id"]]=$result["sum(note_score)"];
    }
    $top=array_slice($top,0,5,$preserve_keys=TRUE);
    asort($top);
    $keys=array_keys($top);
    if(!empty($keys))
        $maxKey=max(array_keys($keys));
    else
        $maxKey=-1;
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

//Maj de l'expérience d'un étudiant
function majExp($etudId)
{
    $query="SELECT sum(note_score) from notes where utilisateur_id =?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $sum=$prepQuery->fetch()["sum(note_score)"];
    
    $query="UPDATE user SET utilisateur_experience=? WHERE utilisateur_id=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($sum,$etudId));
}

//Maj du niveau d'un étudiant
function majNiveau($etudId)
{
    $query="SELECT utilisateur_experience FROM user WHERE utilisateur_id=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $exp=$prepQuery->fetch()["utilisateur_experience"];
    
    $query="SELECT max(niveau_id) FROM niveau WHERE niveau_experience<=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($exp));
    if($niveau=$prepQuery->fetch()["max(niveau_id)"])
    {
        $niveau++;
    }
    else{
        $niveau=1;
    }
    
    echo $niveau."<br/>";
    
    $query="UPDATE user SET utilisateur_niveau=? WHERE utilisateur_id=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($niveau,$etudId));
    
}

//Maj des succès d'un étudiant
function majSucces($etudId)
{
    //Succès liés au niveau (1 à 3)
    majSuccesNiveau($etudId);
    
    //Succès liés aux tops (4 à 9)
    majSuccesTop($etudId);
    
}

//Maj des succès liés au niveau pour un étudiant
function majSuccesNiveau($etudId)
{
    $query="SELECT utilisateur_niveau FROM user WHERE utilisateur_id=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $niveau=$prepQuery->fetch()["utilisateur_niveau"];
    $succes=0;
    //Succès niveau 2
    if(!aSucces(1,$etudId) && $niveau>=2)
    {
       $succes=1;
    }
    //Succès niveau 10
    if(!aSucces(2,$etudId) && $niveau>=10)
    {
        $succes=2;
    }
    //Succès niveau 20
    if(!aSucces(3,$etudId) && $niveau>=20)
    {
        $succes=3;
    }
    if($succes!=0){
         $query="INSERT INTO reussisucces VALUES (null,:date,1,:succes,:utilisateur)";
         $prepQuery=getDb()->prepare($query);
         $prepQuery->bindValue("date",date("Y-m-d"));
         $prepQuery->bindValue("succes",$succes);
         $prepQuery->bindValue("utilisateur",$etudId);
         $prepQuery->execute();
    }
}

//Maj des succès liés aux tops pour un étudiant
function majSuccesTop($etudId)
{
    //Entrer dans le top général (4)
    if(!aSucces(4,$etudId)){
        $query="SELECT * FROM top WHERE top_id=0 AND top_pre=? OR top_deux=? OR top_trois=? OR top_quat=? OR top_cinq=?";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId,$etudId,$etudId,$etudId,$etudId));
        if($res=$prepQuery->fetch())
        {
            $query="INSERT INTO reussisucces VALUES(null,:date,1,4,:utilisateur)";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->bindValue("date",date("Y-m-d"));
            $prepQuery->bindValue("utilisateur",$etudId);
            $prepQuery->execute();
        }
    }
    
    //Etre premier du top général (5)
    if(!aSucces(5,$etudId))
    {
        $query="SELECT * FROM top WHERE top_id=0 AND top_pre=?";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        if($res=$prepQuery->fetch())
        {
            $query="INSERT INTO reussisucces VALUES(null,:date,1,5,:utilisateur)";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->bindValue("date",date("Y-m-d"));
            $prepQuery->bindValue("utilisateur",$etudId);
            $prepQuery->execute();
        }
    }
    
    //Entrer dans un top thématique (6)
    if(!aSucces(6,$etudId))
    {
        for($i=1;$i<=6;$i++)
        {
            $query="SELECT * FROM top WHERE top_id=? AND top_pre=? OR top_deux=? OR top_trois=? OR top_quat=? OR top_cinq=?";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->execute(array($i,$etudId,$etudId,$etudId,$etudId,$etudId));
            if($res=$prepQuery->fetch())
            {
                $query="INSERT INTO reussisucces VALUES(null,:date,1,6,:utilisateur)";
                $prepQuery=getDb()->prepare($query);
                $prepQuery->bindValue("date",date("Y-m-d"));
                $prepQuery->bindValue("utilisateur",$etudId);
                $prepQuery->execute();
                break;
            }
        }
    }
}