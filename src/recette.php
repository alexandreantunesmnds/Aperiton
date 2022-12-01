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
        }
    ?>
    <div id="body">
        <div id="recipe">
            <span id=ariane>
                <a href="aperiton.php">Accueil</a> > recette > <a href="#"><?php echo $recipe_title; ?></a>
            </span>
            <div class="recipe">
                <div id="recipe_title">
                    <h1><?php echo $recipe_title; ?></h1>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
