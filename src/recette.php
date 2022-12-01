<!DOCTYPE html>
<html>

<head>
    <title>Aperiton - Page d'accueil</title>
	<meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
</head>

<!-- L'entête -->
<?php include_once('header.php'); ?>

<body>
    <?php 
        if(isset($_GET['nom'])){ 
            $recipe_title = $_GET['nom'];

            /* On recherche la recette dans la bdd */ 
            $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
            $requete = "SELECT ingredients, preparation FROM recettes WHERE nom = '$recipe_title'";
            $exec_requete = mysqli_query($mysqli,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
        }
    ?>
    <div id="body">
        <div id="recipe">
            <span id=ariane>
                <a href="aperiton.php">Accueil</a> > recettes > <a href="#"><?php echo $recipe_title; ?></a>
            </span>
            <div class="recipe">
                <div id="recipe_title">
                    <h1><?php echo $recipe_title; ?></h1>
                </div>
                <div id="recipe_photo">
                    <!-- mettre photo ici -->
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
        </div>
    </div>

</body>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
