<?php

require_once "includes/functions.php";
session_start();

if (isset($_GET['id'] )){
$id=$_GET['id']; 
}
else 
{
    redirect('mathematiciens.php?id=1');
}
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php";  ?>
        
            Voici la page vous présentant les mathématiciens célèbres de LudiMath. </br>
            Vous y trouverez des anecdotes, des liens vers le cour correspondant et des liens utiles.
            </br></br>
            <ul class="nav nav-tabs">
            <?php 
            if ($id!=1)
                echo'<li role="presentation"><a href="mathematiciens.php?id=1">Alkhawarizmi</a></li>';
            else
                echo '<li role="presentation" class="active"><a href="mathematiciens.php?id=1">Alkhawarizmi</a></li>';
            if($id!=2)
                echo'<li role="presentation"><a href="mathematiciens.php?id=2">Waierstrass</a></li>';
            else 
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=2">Waierstrass</a></li>';                
            if($id!=3)
                echo'<li role="presentation"><a href="mathematiciens.php?id=3">Gauss</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=3">Gauss</a></li>';
            if($id!=4)
                echo'<li role="presentation"><a href="mathematiciens.php?id=4">Euler</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=4">Euler</a></li>';
            if($id!=5)
                echo'<li role="presentation"><a href="mathematiciens.php?id=5">Descartes</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=5">Descartes</a></li>';
            if($id!=6)
                echo'<li role="presentation"><a href="mathematiciens.php?id=6">Cauchy</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=6">Cauchy</a></li>';
            if($id!=7)
                echo'<li role="presentation"><a href="mathematiciens.php?id=7">Lagrange</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=7">Lagrange</a></li>';
            if($id!=8)
                echo'<li role="presentation"><a href="mathematiciens.php?id=8">Pascal</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=8">Pascal</a></li>';
            if($id!=9)
                echo'<li role="presentation"><a href="mathematiciens.php?id=9">Rieman</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=9">Rieman</a></li>';
            if($id!=10)
                echo'<li role="presentation"><a href="mathematiciens.php?id=10">Perelman</a></li>';
            else
                echo'<li role="presentation" class="active"><a href="mathematiciens.php?id=10">Perelman</a></li>';
                   
                  echo'</ul>' ;                 
                  
                  
            if($id==1)
            {
                echo"</br>";
                echo"\t Né dans les années 780, Muhammad Ibn Mūsā al-Khuwārizmī propose la première approche systématique des équations de second et de premier de degré. Son oeuvre est à l’origine de l’utilisation des chiffres arabes en Europe et au Moyen-Orient."; 
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(37);
            }
            if($id==2)
            {
                echo"</br>";
                echo"\t Né en 1815, Karl Weierstrass est un mathématiciens Allemand du XIXème siècle. Il est considéré comme l’un des pères de “l’analyse moderne”. Il terminera les 3 dernières années de sa vie immobile, et meurt à Berlin en 1897.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(38);
                echo"</br>";echo"</br>";echo"Cours associés :";
                        echo'<li><a href="cours/Fonctions.pdf">Fonctions</a></li>
                        <li><a href="cours/Suites.pdf">Suites</a></li>';
                
            }
            if($id==3)
            {
                echo"</br>";
                echo"\t Né en 1777, Carl Friedrich Gauss, aussi surnommé le Prince des Mathématiques est à l'origine de nombreux théorèmes comme le pivot de Gauss. Ses travaux en mathématiques comme en physique ainsi que ses notes publiées de manière posthume sont considérés encore aujourd’hui comme fondamentaux. A 19 ans il découvert le moyen de découper un cercle en 17 parties.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(39);
                
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Matrices.pdf">Matrices</a></li>';
                
            }
            if($id==4)
            {
                echo"</br>";
                echo"\t Né en 1707, Leonhard Euler est vu comme le mathématicien le plus prolifique de tous les temps. C’est lui que développe l’analyse durant le XVIII ème siècle.  Il deviendra complètement aveugle durant les 17 dernières années de sa vie, ce qui ne l'empêcha pas de continuer ces travaux en mathématique grâce à une mémoire hors norme.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(40);
                
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Complexes.pdf">Nombres complexes</a></li>';
                
            }
            if($id==5)
            {
                echo"</br>";
                echo"\t Né en 1596, René Descartes est souvent perçu comme un philosophe mais il a aussi beaucoup oeuvré dans les mathématiques. Son fait d’arme principale est d’avoir numérisé la géométrie et ainsi permis de relier la géométrie à l’algèbre. Petite note amusant c’est liu qui a systématisé la notation : x^n (bien écris en petit) pour les puissances.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(41);
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Fonctions.pdf">Fonctions</a></li>';
            }
            if($id==6)
            {
                echo"</br>";
                echo"\t Né en 1789, Augustin Louis Cauchy fut depuis son plus jeune âge reconnu comme un génie :  Lagrange dira de lui : « Vous voyez ce petit homme, eh bien ! Il nous remplacera tous tant que nous sommes de géomètres ». Il écrira au cours de sa vie 7 livres couvrant tous les domaines mathématiques de l’époque. Il décédera malheureusement d’un rhume en 1857.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(42);
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Fonctions.pdf">Fonctions</a></li>';
                
            }
            if($id==7)
            {
                echo"</br>";
                echo"\t Né en 1736, Joseph louis Lagrange est un mathématiciens mais aussi astronome Italiens (il deviendra français au cours de sa vie). A 19 ans il écrit une lettre à Euler afin de lui proposer la solution a un problème. Euler appréciait la démarche et mis à disposition tous ces travaux afin que Lagrange puisse finir ces travaux. Il découvrit également en astronomie la poin Lagrange qui se trouve être l’exacte endroit ou la force gravitationnelle de à Terre est égale à celle de la Lune.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(43);
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Fonctions.pdf">Fonctions</a></li>';
                
            }
            if($id==8)
            {
                echo"</br>";
                echo"\t Né en 1623, Blaise Pascal est un mathématicien des plus célèbre. Mais il est aussi philosophe, physicien, inventeur, et plein d’autre chose. Mais ici se sont les mathématiques qui nous intéresse (rappelez vous, nous sommes sur LudiMATH !). C’est notamment lui le premier à avoir créé la “machine à calculer” (a 19 ans quand même). Après t'inquiète pas il a fait des trucs avant, en effet à 16 ans il avait déjà écrit un traité de de géométrie projective. Il meurt à 39 ans après une longue maladie (et des migraines très violentes).";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(44);
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Fonctions.pdf">Fonctions</a></li>';
                
            }
            if($id==9)
            {
                echo"</br>";
                echo"\t Né en 1826, Bernhard Riemann est un mathématiciens Allemand, qui vous connaissez sans doute. Pour vous situer le personnage, au lycée il a lu en 1 semaine : La théorie des Nombres de Légende de 900 pages et dira après : “C’est un livre merveilleux; je le connais par coeur”. Il poursuit donc sa vie tout naturellement dans les maths, et mourut en 1866, sur les Rives du Lac Majeur en Italie.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(45);
                echo"</br>";echo"</br>";echo"Cours associé :";
                        echo'<li><a href="cours/Fonctions.pdf">Fonctions</a></li>';
                
            }
            if($id==10)
            {
                echo"</br>";
                echo"\t Né en en 1966, Grigori Perelman s’est vu décerner la médaille Fields et le prix Clay suite à la résolution d’un des septs problèmes du prix du millénaire : la conjecture de Poincaré. Il a refusé ces deux récompenses.";
                echo"</br>";echo"</br>";echo"Succes associé : ";
                afficheContenuSucces(46);
                
            }
            
            ?>
        </div>
        
        
        </div>
    </body>
        
<?php require_once "includes/scripts.php"; ?>
</html>