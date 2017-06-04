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

//Check if the user is an admin
function isUserAdmin($userId){
    $prepQuery=getDb()->prepare("SELECT utilisateur_admin FROM user WHERE utilisateur_id=?");
    $prepQuery->execute(array($userId));
    return ($prepQuery->fetch()["utilisateur_admin"]==1);
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
    //perelman
    $query="SELECT count(*) FROM reussisucces WHERE utilisateur_id=".$userId;
    $res= getDb()->query($query);        
    $count=$res->fetch();            
    $query="SELECT badge_id FROM user WHERE utilisateur_id=?";    
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($userId));
    $res=$prepQuery->fetch();    
    $badgeId=$res['badge_id'];
    if($count['count(*)']>9 && $badgeId==36)
    {
        ReussirSucces(46, $userId);
    }
    //notifssucces
    $prepQuery=getDb()->prepare("SELECT succes_id,reussite_id FROM reussisucces WHERE utilisateur_id=? AND afficher_succes=1");
    $prepQuery->execute(array($userId));    
    foreach($prepQuery as $id){ 
        echo' <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Succes Obtenu ! 
        ';
        afficheContenuSucces($id['succes_id']);
        echo'</div>';
        $query="UPDATE reussisucces SET afficher_succes=0 WHERE reussite_id=:id";           
        $prepQuery=getDb()->prepare($query);
        $prepQuery->bindValue("id",$id['reussite_id']);
        $prepQuery->execute();
    }
}

//SuccesConnexion
function SuccesConnection($userdId)
{
    $heure = date("G");
    $minute = date("i");
    if (11<$heure && $heure <14)
    {ReussirSucces(28,$userdId);}
    else if (20<$heure && $heure <=24)
    {ReussirSucces(29,$userdId);}
    else if (5<$heure && $heure <9)
    {ReussirSucces(30,$userdId);}
    else if (7<$heure && $heure <9)
    {ReussirSucces(31,$userdId);}
    else if (2<$heure && $heure <4)
    {
        if(12<$minute && $minute<16)
        {ReussirSucces(32,$userdId);}
    }
    if (aSucces(28,$userdId)!=0 && aSucces(29,$userdId)!=0 && aSucces(30,$userdId)!=0 && aSucces(31,$userdId)!=0 && aSucces(32,$userdId)!=0)
    {ReussirSucces(33,$userdId);}
}

//ReussirSucces
function ReussirSucces($succesId,$userId)
{
    if(!aSucces($succesId,$userId))
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

//affiche les succes du joueur
function afficheSucces($utilisateur_id){
    $query ="Select succes_id from reussisucces where utilisateur_id=? order by succes_id";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));

    foreach($prepQuery as $id){
        if($id['succes_id']!=36)
        {
            afficheContenuSucces($id['succes_id']); 
            echo'</br>';
        }
    }

    $query ="SELECT succes_id,succes_cache FROM succes WHERE succes_id NOT IN (SELECT succes_id from reussisucces where utilisateur_id=?) Order By succes_cache,succes_id";
    $prepQuery=getDB()->prepare($query);
    $prepQuery->execute(array($utilisateur_id));
    foreach($prepQuery as $id){
        if($id['succes_id']!=36)
        {
            afficheSuccesNonObtenu($id['succes_id']);  
            echo'</br>';
        }
    }

}

//Changer le badge de l'utilisateur
function changerbadge($badgeid,$userId){

    if(asucces($badgeid,$userId)!=0){
        echo "oui.";
        $query="UPDATE user SET badge_id = :badge WHERE utilisateur_id = :user";
        $prepQuery = getDB()->prepare($query);
        $prepQuery->bindValue('badge', $badgeid, PDO::PARAM_INT);
        $prepQuery->bindValue('user', $userId, PDO::PARAM_INT);

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
        echo"<a href='changerbadge.php?badge=".$badge_id."'><img src='images/badges/".$badge."' alt='".$badge."' height=".$taille."width=".$taille." ></a>";
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
    echo"<span class='div2'>";
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
                    echo"Places à prendre";
                }
            }
            else
            {
                echo"Places à prendre";
            }
        }
        else
        {
            echo"Places à prendre";
        }
    }//reflechir aux noms trop grands
    else
    {
        echo"Places à prendre";
    }
    echo"</ul>";echo"</span>";

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

//MAJ du score des équipes
function majEquipes()
{
    for($i=1;$i<=2;$i++)
    {
        $prepQuery=getDb()->prepare("SELECT sum(note_score) as score FROM notes WHERE utilisateur_id IN (SELECT utilisateur_id FROM user WHERE equipe_id=?)");
        $prepQuery->execute(array($i));
        $score=$prepQuery->fetch()["score"];
        if($score==null)
        {
            $score=0;
        }

        $prepQuery=getDb()->prepare("UPDATE equipe SET equipe_score=? WHERE equipe_id=?");
        $prepQuery->execute(array($score,$i));
    }
}

//Maj de l'expérience d'un étudiant
function majExp($etudId)
{
    $query="SELECT sum(note_score) from notes where utilisateur_id =?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $sum=$prepQuery->fetch()["sum(note_score)"];
    if($sum==null)
        $sum=0;

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

    //Succès liés aux équipes (10 à 12)
    majSuccesEquipe($etudId);

    //Succès 10/10 (13 à 14)
    majSuccesDix($etudId);

    //Succès liés au nombre d'exercices réussis (15 à 19)
    majSuccesExercicesReussis($etudId);

    //Succès liés au nombre d'exercices réussis à la suite (20 à 22)
    majSuccesExercicesReussisALaSuite($etudId);

    //Succès liés au nombre d'exercices ratés à la suite (23 à 24)
    majSuccesExercicesRatesALaSuite($etudId);

    //Succès de progression (25 à 27)
    majSuccesProgression($etudId);

    //Succès de badges (34 à 35)
    majSuccesBadges($etudId);

    //Succès liés aux mathématiciens (36 à 45)
    majSuccesMathematiciens($etudId);
}

//Maj des succès liés au niveau pour un étudiant (1 à 3)
function majSuccesNiveau($etudId)
{
    $query="SELECT utilisateur_niveau FROM user WHERE utilisateur_id=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $niveau=$prepQuery->fetch()["utilisateur_niveau"];
    //Succès niveau 2
    if(!aSucces(1,$etudId) && $niveau>=2)
    {
        ReussirSucces(1,$etudId);
    }
    //Succès niveau 10
    if(!aSucces(2,$etudId) && $niveau>=10)
    {
        ReussirSucces(2,$etudId);
    }
    //Succès niveau 20
    if(!aSucces(3,$etudId) && $niveau>=20)
    {
        ReussirSucces(3,$etudId);
    }
}

//Maj des succès liés aux tops pour un étudiant (4 à 9)
function majSuccesTop($etudId)
{
    //Entrer dans le top général (4)
    if(!aSucces(4,$etudId)){
        $query="SELECT * FROM top WHERE top_id=0 AND top_pre=? OR top_deux=? OR top_trois=? OR top_quat=? OR top_cinq=?";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId,$etudId,$etudId,$etudId,$etudId));
        if($res=$prepQuery->fetch())
        {
            ReussirSucces(4,$etudId);
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
            ReussirSucces(5,$etudId);
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
                ReussirSucces(6,$etudId);
                break;
            }
        }
    }

    //Entrer dans tous les tops thématiques (7)
    if(!aSucces(7,$etudId))
    {
        $nbTop=0;
        for($i=1;$i<=6;$i++)
        {
            $query="SELECT * FROM top WHERE top_id=? AND top_pre=? OR top_deux=? OR top_trois=? OR top_quat=? OR top_cinq=?";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->execute(array($i,$etudId,$etudId,$etudId,$etudId,$etudId));
            if($res=$prepQuery->fetch())
                $nbTop++;
            else
                break;
        }
        if($nbTop==6)
            ReussirSucces(7,$etudId);
    }

    //Entrer dans le top général et tous les tops thématiques (8)
    if(!aSucces(8,$etudId))
    {
        $nbTop=0;
        for($i=0;$i<=6;$i++)
        {
            $query="SELECT * FROM top WHERE top_id=? AND top_pre=? OR top_deux=? OR top_trois=? OR top_quat=? OR top_cinq=?";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->execute(array($i,$etudId,$etudId,$etudId,$etudId,$etudId));
            if($res=$prepQuery->fetch())
                $nbTop++;
            else
                break;
        }
        if($nbTop==7)
            ReussirSucces(8,$etudId);
    }

    //Etre premier dans le top général et tous les tops thématiques (9)
    if(!aSucces(9,$etudId))
    {
        $nbTop=0;
        for($i=0;$i<=6;$i++)
        {
            $query="SELECT * FROM top WHERE top_id=? AND top_pre=?";
            $prepQuery=getDb()->prepare($query);
            $prepQuery->execute(array($i,$etudId));
            if($res=$prepQuery->fetch())
                $nbTop++;
            else
                break;
        }
        if($nbTop==7)
            ReussirSucces(9,$etudId);
    }
}

//Maj des succès d'équipe (10 à 12)
function majSuccesEquipe($etudId)
{
    $query="SELECT equipe_score FROM equipe WHERE equipe_id=(SELECT equipe_id FROM user WHERE utilisateur_id=?)";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $scoreEquipe=intval($prepQuery->fetch()["equipe_score"]);

    //Obtenir un score d'équipe de 500 (10)
    if(!aSucces(10,$etudId) && $scoreEquipe>500)
    {
        ReussirSucces(10,$etudId);
    }
    //Obtenir un score d'équipe de 2500 (11)
    if(!aSucces(11,$etudId) && $scoreEquipe>2500)
    {
        ReussirSucces(11,$etudId);
    }
    //Obtenir un score d'équipe de 10 000 (12)
    if(!aSucces(12,$etudId) && $scoreEquipe>10000)
    {
        ReussirSucces(12,$etudId);
    }
}

//Maj des succès 10/10 (13 à 14)
function majSuccesDix($etudId)
{
    //Recupération du nombre d'exercices avec 10/10
    $query="SELECT count(DISTINCT exercice_id) as nbDix FROM notes WHERE utilisateur_id=? AND note_score=10";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $nbDix=$prepQuery->fetch()["nbDix"];

    //Obtenir 10/10 à 20 exercices(13)
    if(!aSucces(13,$etudId) && $nbDix>=20)
    {
        ReussirSucces(13,$etudId);
    }

    //Obtenir 10/10 à tous les exercices (14)
    if(!aSucces(14,$etudId))
    {
        $query="SELECT count(exercice_id) as nbExos from exercice";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute();
        $nbExos=$prepQuery->fetch()["nbExos"];

        if($nbDix == $nbExos)
            ReussirSucces(14,$etudId);
    }
}

//Maj des succès liés au nombre d'exercices réussis (15 à 19)
function majSuccesExercicesReussis($etudId)
{
    $query="SELECT COUNT(exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $nbExosReussis=$prepQuery->fetch()["nbExos"];

    //Réussir 10 exercices (15)
    if(!aSucces(15,$etudId) && $nbExosReussis>=10)
    {
        ReussirSucces(15,$etudId);
    }

    //Réussir 25 exercices (16)
    if(!aSucces(16,$etudId) && $nbExosReussis>=25)
    {
        ReussirSucces(16,$etudId);
    }

    //Réussir 100 exercices (17)
    if(!aSucces(17,$etudId) && $nbExosReussis>=100)
    {
        ReussirSucces(17,$etudId);
    }

    //Réussir 500 exercices (18)
    if(!aSucces(18,$etudId) && $nbExosReussis>=500)
    {
        ReussirSucces(18,$etudId);
    }

    //Réussir 1000 exercices (19)
    if(!aSucces(19,$etudId) && $nbExosReussis>=1000)
    {
        ReussirSucces(19,$etudId);
    }
}

//Maj des succès liés au nombre d'exercices réussis à la suite (20 à 22)
function majSuccesExercicesReussisALaSuite($etudId)
{
    $query="SELECT note_score FROM notes WHERE utilisateur_id=? ORDER BY note_date DESC";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));

    $resultats=array();
    while($res=$prepQuery->fetch())
    {
        array_push($resultats,$res["note_score"]);
    }
    //Calcul du nombre maximum d'exercices réussis à la suite.
    $nbReussiMax=0;
    for($i=0;$i<count($resultats)-$nbReussiMax;$i++)
    {
        if($resultats[$i]>=5)
        {
            $nbReussis=1;
            for($j=1;$j<count($resultats)-$i;$j++)
            {
                if($resultats[$i+$j]<5)
                    break;
                else
                    $nbReussis++;
            }
            if($nbReussis>$nbReussiMax)
                $nbReussiMax=$nbReussis;
        }
    }

    //Réussir 5 exercices à la suite (20)
    if(!aSucces(20,$etudId) && $nbReussiMax>=5)
        ReussirSucces(20,$etudId);

    //Réussir 10 exercices à la suite (21)
    if(!aSucces(21,$etudId) && $nbReussiMax>=10)
        ReussirSucces(21,$etudId);

    //Réussir 20 exercices à la suite (22)
    if(!aSucces(22,$etudId) && $nbReussiMax>=20)
        ReussirSucces(22,$etudId);
}

//Maj des succès liés au nombre d'exercices ratés à la suite (23 à 24)
function majSuccesExercicesRatesALaSuite($etudId)
{
    $query="SELECT note_score FROM notes WHERE utilisateur_id=? ORDER BY note_date DESC";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));

    $resultats=array();
    while($res=$prepQuery->fetch())
    {
        array_push($resultats,$res["note_score"]);
    }

    //Calcul du nombre maximum d'exercices ratés à la suite.
    $nbRateMax=0;
    for($i=0;$i<count($resultats)-$nbRateMax;$i++)
    {
        if($resultats[$i]<5)
        {
            $nbRates=1;
            for($j=1;$j<count($resultats)-$i;$j++)
            {
                if($resultats[$i+$j]>=5)
                    break;
                else
                    $nbRates++;
            }
            if($nbRates>$nbRateMax)
                $nbRateMax=$nbRates;
        }
    }

    //Rater 5 exercices à la suite (23)
    if(!aSucces(23,$etudId) && $nbRateMax>=5)
        ReussirSucces(23,$etudId);

    //Rater 10 exercices à la suite (24)
    if(!aSucces(24,$etudId) && $nbRateMax>=10)
        ReussirSucces(24,$etudId);
}

//Maj des succès de progression (25 à 27)
function majSuccesProgression($etudId)
{
    $nbThematiqueFinies=0;
    for($i=1;$i<7;$i++)
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=?)";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute(array($i));
        $nbExosThematique=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=?))";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId,$i));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExosThematique==$nbExosReussis)
        {
            $nbThematiqueFinies++;
        }
    }

    //Reussir tous les exercices d'une thématique (25)
    if(!aSucces(25,$etudId) && $nbThematiqueFinies>=1)
    {
        ReussirSucces(25,$etudId);
    }

    //Reussir tous les exercices de 3 thématiques (26)
    if(!aSucces(26,$etudId) && $nbThematiqueFinies>=3)
    {
        ReussirSucces(26,$etudId);
    }

    //Reussir tous les exercices de toutes les thématiques (27)
    if(!aSucces(27,$etudId) && $nbThematiqueFinies>=6)
    {
        ReussirSucces(27,$etudId);
    }

}

//Maj des succès de badges (34 à 35)
function majSuccesBadges($etudId)
{
    $query="SELECT COUNT(DISTINCT succes_id) as nbSucces FROM reussisucces WHERE utilisateur_id=?";
    $prepQuery=getDb()->prepare($query);
    $prepQuery->execute(array($etudId));
    $nbBadges=$prepQuery->fetch()["nbSucces"] +1;

    //Posséder 15 badges (34)
    if(!aSucces(34,$etudId) && $nbBadges>=15)
        ReussirSucces(34,$etudId);

    //Posséder tous les badges (35)
    if(!aSucces(35,$etudId) && $nbBadges>=36)
        ReussirSucces(35,$etudId);
}

//Maj des succès liés aux mathématiciens (36 à 45)
function majSuccesMathematiciens($etudId)
{
    //Réussir 3 fois l'exercice Variations d'un trinôme du second degré 1 (36)
    if(!aSucces(36,$etudId))
    {
        $query="SELECT COUNT(note_id) as nbNote FROM notes WHERE utilisateur_id=? AND exercice_id=30 AND note_score>=5";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbReussites=$prepQuery->fetch()["nbNote"];

        if($nbReussites>=3)
            ReussirSucces(36,$etudId);
    }

    //Réussir tous les exercices sur les limites (37)
    if(!aSucces(37,$etudId))
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id=2";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute();
        $nbExos=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id=2)";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExos==$nbExosReussis)
        {
            ReussirSucces(37,$etudId);
        }
    }

    //Réussir tous les exercices sur les matrices (38)
    if(!aSucces(38,$etudId))
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=6)";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute();
        $nbExos=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=6))";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExos==$nbExosReussis)
        {
            ReussirSucces(38,$etudId);
        }
    }

    //Réussir tous les exercices sur les complexes (39)
    if(!aSucces(39,$etudId))
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id=13";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute();
        $nbExos=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id=13)";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExos==$nbExosReussis)
        {
            ReussirSucces(39,$etudId);
        }
    }

    //Réussir tous les exercices sur l'étude de fonctions (40)
    if(!aSucces(40,$etudId))
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=1)";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute();
        $nbExos=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=1))";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExos==$nbExosReussis)
        {
            ReussirSucces(40,$etudId);
        }
    }

    //Réussir tous les exercices sur la continuité (41)
    if(!aSucces(41,$etudId))
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id=5";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute();
        $nbExos=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id=5)";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExos==$nbExosReussis)
        {
            ReussirSucces(41,$etudId);
        }
    }

    //Réussir 3 fois l'exercice Calcul de dérivée composée 1 (42)
    if(!aSucces(42,$etudId))
    {
        $query="SELECT COUNT(note_id) as nbNote FROM notes WHERE utilisateur_id=? AND exercice_id=20 AND note_score>=5";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbReussites=$prepQuery->fetch()["nbNote"];

        if($nbReussites>=3)
            ReussirSucces(42,$etudId);
    }

    //Réussir 3 fois l'exercice Tangente à une courbe polynemiale (43)
    if(!aSucces(43,$etudId))
    {
        $query="SELECT COUNT(note_id) as nbNote FROM notes WHERE utilisateur_id=? AND exercice_id=17 AND note_score>=5";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbReussites=$prepQuery->fetch()["nbNote"];

        if($nbReussites>=3)
            ReussirSucces(43,$etudId);
    }

    //Réussir tous les exercices sur les intégrales (44)
    if(!aSucces(44,$etudId))
    {
        $queryCount="SELECT COUNT(exercice_id) as nbExo FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=5)";
        $prepQueryCount=getDb()->prepare($queryCount);
        $prepQueryCount->execute();
        $nbExos=$prepQueryCount->fetch()["nbExo"];

        $query="SELECT COUNT(DISTINCT exercice_id) as nbExos FROM notes WHERE utilisateur_id=? AND note_score>=5 AND exercice_id IN (SELECT exercice_id FROM exercice WHERE feuille_id IN (SELECT feuille_id from feuille WHERE theme_id=5))";
        $prepQuery=getDb()->prepare($query);
        $prepQuery->execute(array($etudId));
        $nbExosReussis=$prepQuery->fetch()["nbExos"];

        if($nbExos==$nbExosReussis)
        {
            ReussirSucces(44,$etudId);
        }
    }
}