<!DOCTYPE html>
<html>

<head>
        <title>Aperiton - Page d'accueil</title>
	    <meta charset="utf-8" />
        <!-- Importation du fichier style css -->
        <link rel="stylesheet" href="outils/style.css" media="screen" type="text/css" />
</head>

<body>
    <!-- L'entête -->
    <?php include_once('header.php'); ?>

    <!-- Le corps de page -->
    <div id="body" >
        <div id="random_recipe">
            <?php
                /* Connexion à la base de données */
                $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");

                $requete = "SELECT count(*) FROM recettes";
                $exec_requete = mysqli_query($mysqli,$requete);
                $reponse = mysqli_fetch_array($exec_requete);
                $count = $reponse['count(*)'];

                /* On génère aléatoirement 3 nombre entre 1 et le nombre totale de recette */ 
                $random_id_recipe_1 = rand(1,$count);
                $random_id_recipe_2 = rand(1,$count);

                /* On vérifie qu'on est pas obtenue les mêmes chiffres*/
                while($random_id_recipe_2 == $random_id_recipe_1){
                    $random_id_recipe_2 = rand(1,$count);
                }
                $random_id_recipe_3 = rand(1,$count);
                while($random_id_recipe_3 == $random_id_recipe_2 || $random_id_recipe_3 == $random_id_recipe_1){
                    $random_id_recipe_3 = rand(1,$count);
                }
                //echo "1: ".$random_id_recipe_1." 2: ".$random_id_recipe_2." 3: ".$random_id_recipe_3;
                $requete = "SELECT nom, ingredients, preparation FROM recettes WHERE id_recette = $random_id_recipe_1";
                $exec_requete = mysqli_query($mysqli,$requete);
                $reponse = mysqli_fetch_array($exec_requete);
                echo $reponse['nom']." : ".$reponse['ingredients']."<br>";
                $requete = "SELECT nom, ingredients, preparation FROM recettes WHERE id_recette = $random_id_recipe_2";
                $exec_requete = mysqli_query($mysqli,$requete);
                $reponse = mysqli_fetch_array($exec_requete);
                echo $reponse['nom']." : ".$reponse['ingredients']."<br>";
                $requete = "SELECT nom, ingredients, preparation FROM recettes WHERE id_recette = $random_id_recipe_3";
                $exec_requete = mysqli_query($mysqli,$requete);
                $reponse = mysqli_fetch_array($exec_requete);
                echo $reponse['nom']." : ".$reponse['ingredients']."<br>";
            ?>
        </div>  
    </div>

    <!-- Le pied de page -->
    <?php include_once('footer.php'); ?>
</body>
</html>