insert into equipe values
(null,0,"LesBleus");
insert into equipe values
(null,0,"LesRouges");
insert into equipe values
(null,0,"Admin");

insert into niveau values
(null,15);
insert into niveau values
(null,25);
insert into niveau values
(null,40);
insert into niveau values
(null,60);
insert into niveau values
(null,80);
insert into niveau values
(null,100);
insert into niveau values
(null,125);
insert into niveau values
(null,150);
insert into niveau values
(null,200);
insert into niveau values
(null,300);

insert into user values
(null, "Bazin", "Tom","tbazin","tbazin",10,1,0,1,36);
insert into user values
(null, "Vallee", "Tom","tvallee","tvallee",10,1,0,1,36);
insert into user values
(null, "Hazard", "Sylvain","shazard","shazard",10,1,0,1,36);
insert into user values
(null, "Guerin", "Noemie","nguerin","nguerin",10,1,0,1,36);
insert into user values
(null, "Saracco", "Jerome","jsaracco","jsaracco",80,8,0,1,36);
insert into user values
(null, "Balssa", "Floriane","fbalssa","fblassa",15,5,0,2,36);
insert into user values
(null, "Dupond", "Jules","jdupond","jdupond",20,4,0,2,36);
insert into user values
(null, "Rigal", "Julien","jrigal","jrigal",20,6,0,2,36);
insert into user values
(null, "Perrie", "Quentin","qperrie","qperrie",20,9,0,2,36);
insert into user values
(null, "Sta", "Juliette","jsta","jsta",20,4,0,2,36);
insert into user values
(null,"Admin","Admin","admin","admin",0,1,1,3,36);

insert into admin values
(null,"Admin","admin");

insert into top values 
(0,"Général",5,4,1,3,2);
insert into top values
(1,"Continuité et limites",5,1,3,2,4);
insert into top values
(2,"Suite",5,4,1,2,3);
insert into top values
(3,"Integration",5,4,3,2,1);
insert into top values
(4,"Matrice",5,2,1,4,3);
insert into top values
(5,"Etude de fonctions",1,2,3,4,5);
insert into top values
(6,"Complexes",1,2,3,4,5);

insert into theme values
(null,"Etude de fonctions",5);
insert into theme values
(null,"Continuité et limites",1);
insert into theme values
(null,"Suites",2);
insert into theme values
(null,"Complexes",6);
insert into theme values
(null,"Integration",3);
insert into theme values
(null,"Matrice",4);

insert into feuille values
(1,"Fonctions et graphes",1);
insert into feuille values
(2,"Dérivées et études de fonction",1);
insert into feuille values
(3,"Suites",3);
insert into feuille values
(4,"Dérivations en folies",1);
insert into feuille values
(5,"Continuité",2);
insert into feuille values
(6,"Limites",2);
insert into feuille values
(7,"Calcul d'intégrales",5);
insert into feuille values
(9,"Définitions de Matrices somme et produit",6);
insert into feuille values
(10,"Rang trace et déterminant",6);
insert into feuille values
(11,"Valeurs propres, vecteurs propres et diagonalisation",6);
insert into feuille values
(13,"Complexes",4);

insert into exercice values
(null,"Fonctions et graphes","",1,1);
insert into exercice values
(null,"Fonctions et graphes","",1,2);
insert into exercice values
(null,"Fonctions et graphes","",1,3);
insert into exercice values
(null,"Fonctions et graphes","",1,4);
insert into exercice values
(null,"Fonctions et graphes","",1,5);
insert into exercice values
(null,"Association de fonctions I","",1,6);
insert into exercice values
(null,"Correspondance Fonctions/ens. de définition","",1,7);
insert into exercice values
(null,"Ensemble de définition d'un quotient (1)","",1,8);
insert into exercice values
(null,"Ensemble de définition d'un quotient (2)","",1,9);

insert into exercice values
(null,"Formules1 (monomes)","",4,1);
insert into exercice values
(null,"Dérivée de polynome","",4,2);
insert into exercice values
(null,"Dérivée d'un quotient simple","",4,3);
insert into exercice values
(null,"Dérivée de logarithme","",4,4);
insert into exercice values
(null,"Formules3 (exponentielles)","",4,5);
insert into exercice values
(null,"Formules5 (sqrt; 1/x)","",4,6);
insert into exercice values
(null,"Formules6 (sin et cos)","",4,7);
insert into exercice values
(null,"Tangente à une courbe polynomiale","",4,8);
insert into exercice values
(null,"Tangente à une courbe (avec exp)","",4,9);
insert into exercice values
(null,"Calcul de dérivée composée 4","",4,10);

insert into exercice values
(null,"Calcul de dérivée composée 1","",2,1);
insert into exercice values
(null,"Calcul de dérivée composée 2","",2,2);
insert into exercice values
(null,"Calcul de dérivée composée 3","",2,3);
insert into exercice values
(null,"Calcul de dérivée composée 4","",2,4);
insert into exercice values
(null,"Calcul de dérivée successives 1","",2,5);
insert into exercice values
(null,"Calcul de dérivée successives 2","",2,6);
insert into exercice values
(null,"Calcul de dérivée successives 3","",2,7);
insert into exercice values
(null,"Calcul direct de dérivée 2","",2,8);
insert into exercice values
(null,"Calcul direct de dérivée 3","",2,9);
insert into exercice values
(null,"Calcul direct de dérivée 4","",2,10);
insert into exercice values
(null,"Variation d'un trinôme du second degré 1","",2,11);
insert into exercice values
(null,"Dérivée avec exponentielle 4","",2,12);
insert into exercice values
(null,"Tableau de variations avec exp 2","",2,13);
insert into exercice values
(null,"Variations avec logarithme 2","",2,14);
insert into exercice values
(null,"Variations avec exponentielle 1","",2,15);

insert into exercice values
(null,"La fonction est-elle continue 1","",5,1);
insert into exercice values
(null,"La fonction est-elle continue 2","",5,2);
insert into exercice values
(null,"La fonction est-elle continue 3","",5,3);
insert into exercice values
(null,"La fonction est-elle continue 4","",5,4);
insert into exercice values
(null,"Pourquoi une fonction est continue continue 1","",5,5);
insert into exercice values
(null,"Rendre une fonction continue 1","",5,6);
insert into exercice values
(null,"Rendre une fonction continue 2","",5,7);
insert into exercice values
(null,"Rendre une fonction continue 3","",5,8);
insert into exercice values
(null,"Rendre une fonction continue 4","",5,9);

insert into exercice values
(null,"Calcul de limites","",6,1);
insert into exercice values
(null,"Croissances comparées I","",6,2);
insert into exercice values
(null,"Croissances comparées II","",6,3);
insert into exercice values
(null,"Limite de quotients","",6,4);
insert into exercice values
(null,"Limites de franctions rationnelles","",6,5);
insert into exercice values
(null,"Limites fractions rationnelles et ln","",6,6);

insert into exercice values
(null,"Fraction 2 termes","",3,1);
insert into exercice values
(null,"Comparaison de croissance","",3,2);
insert into exercice values
(null,"Comparaison de suites","",3,3);
insert into exercice values
(null,"Convergence et différence de termes","",3,4);
insert into exercice values
(null,"Deux limites","",3,5);
insert into exercice values
(null,"Fonction de récurrence","",3,6);
insert into exercice values
(null,"Fraction 3 termes","",3,7);
insert into exercice values
(null,"Epsilon","",3,8);
insert into exercice values
(null,"Monotonie I","",3,9);

insert into exercice values
(null,"Complexes","",13,1);
insert into exercice values
(null,"Complexes","",13,2);
insert into exercice values
(null,"Argument de somme","",13,3);
insert into exercice values
(null,"Argument demandé","",13,4);
insert into exercice values
(null,"Fraction","",13,5);
insert into exercice values
(null,"Complexes","",13,6);
 
 insert into exercice values
 (null,"Intégration de base","",7,1);
 insert into exercice values
 (null,"Intégration de base 0","",7,2);
 insert into exercice values
 (null,"Polynôme de degré 2","",7,3);
 insert into exercice values
 (null,"Polynôme de degré 3","",7,4);
 insert into exercice values
 (null,"sin et cos I","",7,5);
 insert into exercice values
 (null,"sin et cos II","",7,6);
 insert into exercice values
 (null,"Primitive et intégrale (fraction exp ou ln)","",7,7);
 insert into exercice values
 (null,"Calcul d'une intégrale","",7,8);
 
 insert into exercice values
 (null,"ABA","",9,1);
 insert into exercice values
 (null,"ABC","",9,2);
 insert into exercice values
 (null,"Opérations de matrices","",9,3);
 insert into exercice values
 (null,"Mult-un 4x4","",9,4);
 insert into exercice values
 (null,"Multiplicabilité","",9,5);
 insert into exercice values
 (null,"Multiplication partielle 3x3","",9,6);
 insert into exercice values
 (null,"Multiplication partielle 4x4","",9,7);
 insert into exercice values
 (null,"Propriétés algébriques","",9,8);
 insert into exercice values
 (null,"Propriétés algébriques II","",9,9);
 insert into exercice values
 (null,"Propriétés de multiplication","",9,10);
 insert into exercice values
 (null,"Taille de AB","",9,11);
 insert into exercice values
 (null,"Formule de coefficient 3x3","",9,12);
 insert into exercice values
 (null,"Formule de coefficient 3x3 II","",9,13);
 insert into exercice values
 (null,"Colonne et ligne 2x3","",9,14);
 insert into exercice values
 (null,"Colonne et ligne 3x3 I","",9,15);
 insert into exercice values
 (null,"Colonne et ligne 3x3 II","",9,16);
 insert into exercice values
 (null,"Images données taille variée","",9,17);
 insert into exercice values
 (null,"Multiplication à 3","",9,18);
 insert into exercice values
 (null,"Multiplication 2x2","",9,19);
 insert into exercice values
 (null,"Multiplication diagonale 2x2","",9,20);
 insert into exercice values
 (null,"Multiplication partielle 3x3","",9,21);
 
 insert into exercice values
 (null,"Trace 2x2","",10,1);
 insert into exercice values
 (null,"Trace 3x3","",10,2);
 insert into exercice values
 (null,"Trace 4x4","",10,3);
 insert into exercice values
 (null,"det 2x2","",10,4);
 insert into exercice values
 (null,"Det et trace 2x2","",10,5);
 insert into exercice values
 (null,"Exemple matrice 2x2","",10,6);
 insert into exercice values
 (null,"det 3x3","",10,7);
 insert into exercice values
 (null,"Det et trace 3x3","",10,8);
 insert into exercice values
 (null,"Déterminant et rang","",10,9);
 insert into exercice values
 (null,"Rang paramétré1","",10,10);
 insert into exercice values
 (null,"Rang paramétré 2","",10,11);
 insert into exercice values
 (null,"Colonne/ligne","",10,12);
 insert into exercice values
 (null,"Addition de lignes","",10,13);
 insert into exercice values
 (null,"Triangulaire 3x3","",10,14);
 insert into exercice values
 (null,"Opérations algébriques","",10,15);
 insert into exercice values
 (null,"det 4x4","",10,16);
 insert into exercice values
 (null,"Exemple 2x2","",10,17);
 insert into exercice values
 (null,"Gauss 3x3","",10,18);
 insert into exercice values
 (null,"Gauss 3x3 II","",10,19);
 insert into exercice values
 (null,"Permutation de lignes 3x3","",10,20);
 insert into exercice values
 (null,"Permutation de lignes 3x3 II","",10,21);
 insert into exercice values
 (null,"Produits donnés","",10,22);
 
 insert into exercice values
 (null,"Valeurs propres 3","",11,1);
 insert into exercice values
 (null,"Vecteurs propres et géométrie","",11,2);
 insert into exercice values
 (null,"Image et vecteurs propres 1","",11,3);
 insert into exercice values
 (null,"Image et vecteurs propres 2","",11,4);
 insert into exercice values
 (null,"Diagonaliser une matrice 2x2","",11,5);
 insert into exercice values
 (null,"Diagonaliser une matrice 3x3 (guidé)","",11,6);
 insert into exercice values
 (null,"Trouver un vecteur propre (I)","",  11,7);





insert into succes values
(null,"Mes premiers pas sur Ludimath",0,"Atteindre le niveau 2");
insert into succes values
(null,"Best of Ludimath",0,"Atteindre le niveau 10");
insert into succes values
(null,"MVP",0,"Atteindre le niveau 20");
insert into succes values
(null,"Dans la cour des grands",1,"Entrer dans le top général");
insert into succes values
(null,"Premier de la classe",1,"Être premier du top général");
insert into succes values
(null,"Premier arrivé, Premier servi",1,"Entrer dans un top thématique");
insert into succes values
(null,"On top of the World",1,"Entrer dans tous les tops thématiques");
insert into succes values
(null,"Touche-à-tout",1,"Entrer dans le top général et dans tous les tops thématiques");
insert into succes values
(null,"Champion Ludimath",1,"Être premier dans le top général et dans tous les tops thématiques");
insert into succes values
(null,"Equipe de Coupe",0,"Obtenir un score d'équipe de 500");
insert into succes values
(null,"Equipe Olympique",0,"Obtenir un score d'équipe de 2500");
insert into succes values
(null,"Champions du Monde",0,"Obtenir un score d'équipe de 10000");
insert into succes values
(null,"10/10",0,"Obtenir 10/10 à 20 exercices");
insert into succes values
(null,"Perfectionniste",0,"Obtenir 10/10 à tous les exercices");
insert into succes values
(null,"Rookie",0,"Réussir 10 exercices");
insert into succes values
(null,"Débutant",0,"Réussir 25 exercices");
insert into succes values
(null,"Et de cent !",0,"Réussir 100 exercices");
insert into succes values
(null,"Tryharder",0,"Réussir 500 exercices");
insert into succes values
(null,"Une tonne d'exercices",0,"Réussir 1000 exercices");
insert into succes values
(null,"Sans faute",0,"Réussir 5 exercices à la suite");
insert into succes values
(null,"Maîtrise",0,"Réussir 10 exercices à la suite");
insert into succes values
(null,"A la chaîne",0,"Réussir 20 exercices à la suite");
insert into succes values
(null,"Besoin d'aide ?",0,"Rater 5 exercices à la suite");
insert into succes values
(null,"Gros Fail !",0,"Rater 10 exercices à la suite");
insert into succes values
(null,"Spécialiste",0,"Réussir tous les exercices d'une thématique");
insert into succes values
(null,"A mi-chemin",0,"Réussir tous les exercices de 3 thématiques");
insert into succes values
(null,"100%",0,"Réussir tous les exercices de toutes les thématiques");
insert into succes values
(null,"En mangeant",1,"Se connecter entre 12h et 14h");
insert into succes values
(null,"Faut dormir aussi",1,"Se connecter entre 21h et 5h");
insert into succes values
(null,"Matinal",1,"Se connecter entre 6h et 8h");
insert into succes values
(null,"Echauffement",1,"Se connecter avant 9h");
insert into succes values
(null,"Pi sur vingt",1,"Se connecter à 3h14");
insert into succes values
(null,"Accro",1,"Obtenir tous les succès de connexion");
insert into succes values
(null,"Collectionneur",0, "Posséder 15 badges");
insert into succes values
(null,"Achiever",0, "Posséder tous les badges");
insert into succes values
(null,"Les fondements de l'algèbre",0,"Réussir 3 fois l'exercice Variations d'un trinôme du second degré 1");
insert into succes values
(null,"Vers l'infini et au-delà",0,"Réussir tous les exercices sur les limites");
insert into succes values
(null,"Gauss Buster",0,"Réussir tous les exercices sur les matrices");
insert into succes values
(null,"La fille d'Euler",0,"Réussir tous les exercices sur les complexes");
insert into succes values
(null,"Les dessous Descartes",0,"Réussir tous les exercices sur l'étude de fonctions");
insert into succes values
(null,"L'arbre qui Cauchy la forêt",0,"Réussir tous les exercices sur la continuité");
insert into succes values
(null,"On va pas en faire tout un foin",0,"Réussir 3 fois l'exercice Calcul de dérivée composée 1");
insert into succes values
(null,"Quand est-ce qu'on Blaise, Pascal ?",0,"Réussir 3 fois l'exercice Tangente à une courbe polynemiale");
insert into succes values
(null,"Riemann et les lapins crétins",0,"Réussir tous les exercices sur les intégrales");


insert into badge values
(null,"premierspas.png");
insert into badge values
(null,"bestofludimath.png");
insert into badge values
(null,"mvp.png");
insert into badge values
(null,"danslacourdesgrands.png");
insert into badge values
(null,"premierdelaclasse.png");
insert into badge values
(null,"premierarrivepremierservi.png");
insert into badge values
(null,"ontopoftheworld.png");
insert into badge values
(null,"toucheatout.png");
insert into badge values
(null,"championludimath.png");
insert into badge values
(null,"equipedecoupe.png");
insert into badge values
(null,"equipeolympique.png");
insert into badge values
(null,"championsdumonde.png");
insert into badge values
(null,"1010.png");
insert into badge values
(null,"perfectionniste.png");
insert into badge values
(null,"rookie.png");
insert into badge values
(null,"debutant.png");
insert into badge values
(null,"etdecent.png");
insert into badge values
(null,"tryharder.png");
insert into badge values
(null,"untonnedexercices.png");
insert into badge values
(null,"sansfaute.png");
insert into badge values
(null,"maitrise.png");
insert into badge values
(null,"alachaine.png");
insert into badge values
(null,"besoindaide.png");
insert into badge values
(null,"grosfail.png");
insert into badge values
(null,"specialiste.png");
insert into badge values
(null,"amichemin.png");
insert into badge values
(null,"100.png");
insert into badge values
(null,"enmangeant.png");
insert into badge values
(null,"fautdormiraussi.png");
insert into badge values
(null,"matinal.png");
insert into badge values
(null,"echauffement.png");
insert into badge values
(null,"pisurvingt.png");
insert into badge values
(null,"accro.png");
insert into badge values
(null,"collectionneur.png");
insert into badge values
(null,"achiever.png");
insert into badge values
(0,"ludimath.png");

INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '1', '1');
INSERT INTO reussisucces
VALUES (NULL, '2017-05-09', '0', '4', '1');
INSERT INTO reussisucces
VALUES (NULL, '2017-05-09', '0', '6', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '7', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '10', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '11', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '15', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '16', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '20', '1');
INSERT INTO reussisucces 
VALUES (NULL, '2017-05-09', '0', '32', '1');
