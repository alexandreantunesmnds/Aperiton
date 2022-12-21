<!DOCTYPE html>
<html>

<head>
    <title>Aperiton - Page d'accueil</title>
	<meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
    <link rel="icon" type="image/png" href="../outils/icon.png" />
</head>

<!-- L'entête -->
<?php include_once('header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<body>
    <?php 
        if(isset($_GET['nom'])){ 
            $recipe_title = $_GET['nom'];

            /* On recherche la recette dans la bdd */ 
            $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
            $requete = "SELECT ingredients, preparation,photo FROM recettes WHERE nom = '$recipe_title'";
            $exec_requete = mysqli_query($mysqli,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
        }
    ?>
    <span id="ariane">
        <a href="aperiton.php">Accueil</a> > recettes > <a href="#"><?php echo $recipe_title; ?></a>
    </span>
    <div id="recipe">
        <div class="recipe">
            <div id="recipe_title">
                <h1><?php echo $recipe_title; ?></h1>
            </div>
            <div id="recipe_photo">
            <img src="../<?php echo $reponse['photo']; ?>">
            </div>
            <div id="recipe_ingredients">
                <hr>
                <h2>Ingrédients</h2>
                <?php echo $reponse['ingredients']; ?>
            </div>
            <div id="recipe_preparation">
                <hr>
                <h2>Préparation</h2>
                <?php echo $reponse['preparation']; ?>
            </div>
        </div>
        <button id="favorite-button"><i class="fa fa-heart"></i> Favoris</button>
        <?php
        if(isset($_SESSION['username'])){
        /* On recherche la recette dans la bdd */ 
        $mysqli=mysqli_connect('localhost', 'root', '','boissons') or die("Erreur de connexion");
        $requete = "SELECT id_recette, ingredients, preparation,photo FROM recettes WHERE nom = '$recipe_title'";
        $exec_requete = mysqli_query($mysqli,$requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $recipe_id = $reponse['id_recette']; // Récupérez l'ID de la recette
        if (isset($_SESSION['user_id'])) {
            // Récupérez l'ID de l'utilisateur de la variable de session
            $user_id = $_SESSION['user_id'];
            } else {
            // L'utilisateur n'est pas connecté, affichez un message d'erreur ou redirigez-le vers la page de connexion
            }
        }
        ?>
    </div>
</body>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
