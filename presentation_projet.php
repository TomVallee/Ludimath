<?php
require_once "includes/functions.php";
session_start();
?>

    <!doctype html>
    <html>

    <?php require_once "includes/head.php"; ?>

        <body>
            <div id="wrap">
                <div class="container nav">
                    <?php require_once "includes/header.php"; ?>
                </div>
                <?php
                    require_once "includes/afficheSucces.php";
                ?>
                <div class="container">
                    <center><img alt="logo" src="images/ludimath.png"></center>

                    <div class="well">
                        <center><h1>Contexte du projet</h1></center>
                        <p>Au début de l’année, les étudiants qui arrivent à l’ENSC ont des profils très variés et n’ont pas tous les mêmes compétences en mathématiques. C’est pourquoi un parcours différencié leur est proposé afin d’harmoniser les connaissances au sein d’une promotion et de pouvoir débuter les enseignements dans les meilleures conditions.
                        Ce parcours s’effectue sur un outil numérique interactif WIMS que nous détaillerons plus loin.</p>
                        <p>Les utilisateurs principaux de ce système seront les futurs étudiants de l’ENSC, lors de leur entrée à l’école, mais aussi les professeurs encadrant le parcours différencié qui auront un rôle d’administrateur.</p>
                        <p>Au fil des années, Mme Coralie Eyraud-Dubois, responsable du parcours différencié, a reçu un certain nombre de feedbacks sur cet outil de la part des étudiants, notamment sur l’interface qui n’est pas toujours adaptée ni engageante.</p>
                        <p>Ainsi le parcours différencié permet aux étudiants de progresser à leur rythme. Cependant le système actuel possède assez peu d’attraits pouvant les motiver à s’impliquer davantage.
                        </p>
                    </div>
                    <div class="well">
                        <center><h1>Demande initiale du client</h1></center>
                        <p>La demande initiale de Mme Coralie Eyraud-Dubois, cliente du projet, était de développer un nouveau système, basé sur l’existant, qui soit plus stable, exempt de problèmes logiciels, avec une interface ergonomique et plaisante à regarder (<a href="presentation_projet/demande_initiale.pdf">Visualiser la demande initiale</a>). Le nouveau système devra également être ludique afin d’optimiser l’expérience des étudiants participant au parcours différencié de mathématiques.</p>
                        <p>Lors de problème rencontrés qui seront décrit dans la partie “Les problèmes rencontrés” nous avons décidé avec le client de modifier certaines exigences de la demande.</p>
                        <p>Ainsi le nouveau site ne remplacera pas totalement WIMS, il sera en étroite liaison avec ce dernier : WIMS permettra aux étudiants d’effectuer les exercices, le site Ludimath récupérera les données de ces exercices et fournira à l’étudiant les fonctionnalités ludiques et attrayantes.
                        </p>
                    </div>
                    <div class="well">
                        <center><h1>Problèmes rencontrés</h1></center>
                        <p>Le principal problème auquel nous avons été confronté est l’importation des exercices de WIMS dans Ludimath. Nous allons le détailler dans cette partie dans le but d’aider le projet groupe qui travaillera sur le projet Ludimath pour comprendre comment améliorer le système.</p>
                        <p>WIMS permet via des liens d’accéder aux exercices, ainsi notre première idée étaient d’insérer ces liens dans le site Ludimath.
                        Cependant WIMS, bien que Opensource, est sécurisé et il ne nous permettait pas d’accéder aux exercices automatiquement via un nom de domaine externe.</p>
                        <p>Nous avons donc vite compris que WIMS ne permettrait pas une telle utilisation des bibliothèque d’exercices. Nous avons tout de même demandé à Bernadette Perrin-Riou, travaillant bénévolement pour WIMS, s’il était possible d’intégrer des exercices à notre site et elle nous a répondu que pour l’instant cela n’était pas possible mais que des personnes travaillaient sur cette fonctionnalité.</p>
                        <p>Ainsi nous espérons que l’intégration des exercices de WIMS soit possible dans quelques années.
                        </p>
                    </div>
                    <div class="well">
                        <center><h1>Travail effectué</h1></center>
                        <h2>Le site WIMS</h2>
                        <p><a href="https://wims.math.cnrs.fr">WIMS</a> sert actuellement à la réalisation des exercices par les étudiants, leurs scores sont stockés dans un fichier.
                        WIMS permet également au professeur en charge du parcours différencié de récupérer le dossier contenant tous les fichiers de scores, dans le but d’alimenter le site Ludimath.
                        Pour récupérer les scores d’un étudiant il faut aller dans : Configuration > Config / Maintenance > Sauvegarde et restauration > Télécharger le dossier de sauvegarde .zip uniquement.
                            Ci-dessous les modifications que nous avons effectué sur le site WIMS :</p>
                        <ul>
                            <li>Amélioration du visuel afin d’être en accord avec le site Ludimath, cependant WIMS ne nous laisse que peu de libertés pour modifier le visuel (seules les couleurs et quelques autres éléments sont modifiables</li>
                            <li>Ajout de cours de mathématiques, ils seront consultables par l’élève :
                                <ul>
                                    <li>à tout moment dans WIMS à cet endroit</li>
                                    <li>lorsqu’il a besoin d’aide sur un exercice, cela le redirige vers la notion du cours correspondante</li>
                                </ul>
                            </li>
                        </ul>
                        <h2>Le site Ludimath</h2>
                        <p>L’impossibilité de récupérer les exercices de WIMS et les intégrer à notre site nous a contraint à réaliser un site non dynamique. Ainsi pour permettre la mise en place de nos solutions de modifications (classement, badges, missions, …), le professeur, après avoir télécharger le dossier de scores côté WIMS, devra l’uploader sur le site Ludimath dans la partie administrateur.</p>
                        <p>Le site traitera ce dossier (extraction des fichiers et récupération de ceux utiles), cela permettra la mise à jour des scores des étudiants et de leurs succès, classement, etc.
                        Cette solution est contraignante mais il a été convenu que cette étape sera réalisée dès que possible par l'enseignant.
                        Ainsi il est attendu pour une prochaine version de site, sur un futur projet, d’améliorer ce système en ayant la possibilité de réaliser des exercices directement dans le site Ludimath.
                        </p>
                    </div>
                    <div class="well">
                        <center><h1>Les livrables réalisés</h1></center>
                        <p>Ci-dessous la liste des livrables que nous avons réalisé et qui nous a permis d’apporter la ludification recherchée pour le site Ludimath.</p>
                        <ul>
                            <li><b>Enquête auprès des étudiants ayant suivi le parcours différencié : </b>Afin de mieux comprendre les besoins des étudiants et les améliorations que nous pourrons effectuer pour ludifier le nouveau site, nous avons effectué une enquête auprès des élèves ayant effectué le parcours différencié. Ce qui est ressorti de l'analyse de l'enquête était principalement une demande de rappels de cours et une amélioration du visuel de WIMS</li>
                            <li><b>Etat de l’art sur les outils de Serious Game et de ludification</b></li>
                            <li><b>Spécifications techniques, proposition d’amélioration du système existant</b></li>
                            <li><b>Ecriture de cours de mathématiques</b></li>
                            <li><b>Réalisation du nouveau site web Ludimath</b></li>
                        </ul>
                    </div>
                    <div class="well">
                        <center><h1>Le point juridique</h1></center>
                        <p>Un des problèmes potentiels est que l’affichage d’informations personnelles sur les étudiants (horaires de connexion, scores, top, etc...) sur le site Ludimath (visibles par tous les membres connectés) pourraient nécessiter une demande à la CNIL.</p> 
                        <p>Cependant, la plate-forme Ludimath est équivalente à un ENT / Moodle. C’est-à-dire que les utilisations de données relatives à l’étudiant sont définies par Bordeaux INP. L’étudiant en prend connaissance lorsqu’il signe les conditions d’utilisation de ses données personnelles en début d’année.</p>
                        <p>A priori il est donc tout à fait possible d’afficher les données telles que les scores, les heures de connexion, sur le site et les rendre visibles aux autres étudiants. 
                        De plus on est assurés que seuls les étudiants ont accès aux données grâce à la connexion CAS.</p>
                        <p>Il est également bien de savoir que WIMS supprime toutes les données relatives à l’étudiant au bout d’un an. En effet, conformément aux déclarations faites à la CNIL,  il n’est pas possible de garder les données ces données plus d’une année. Il est cependant possible de sauvegarder les ressources (feuilles, examens, documents).</p>
                    </div>
                    <div class="well">
                        <center><h1>Evolutivité du projet</h1></center>
                        <p>Dans le but de rendre le site Ludimath dynamique la prochaine évolutivité serait d’intégrer les site de WIMS dans Ludimath. Cela pourra s’effectuer lorsque WIMS le permettra. Une autre solution serait de créer notre propre base de données d’exercices. ce sera un travail long et minutieux mais permettra une autonomie totale du site et l’utilisation d’un seul système.</p>
                        <p>Une autre amélioration serait de faire évoluer Ludimath pour les cours de deuxième année ou la prépa des INP. En effet dans ces deux formations la plateforme WIMS est utilisée pour faire des exercices de mathématiques et cela serait intéressant d’offrir un aspect de ludification pour ces étudiants.
                        </p>
                    </div>
                </div>
            </div>
            
            <?php require_once "includes/footer.php"; ?>
            <?php require_once "includes/scripts.php"; ?>
        </body>
    </html>

