<!DOCTYPE html>
<html>

<head>
        <title>Aperiton - Page de recherche</title>
	    <meta charset="utf-8" />
        <!-- Importation du fichier style css -->
        <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
        <link rel="icon" type="image/png" href="../outils/icon.png" />
</head>

<!-- L'entête -->
<?php include_once('header.php'); ?>

<?php
 /* Requête permettant la recherche de recette à partir de mots clefs (ingrédients ou nom) */
    /* Code à potentiellement déplacé */
    $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
    $requete = "SELECT * FROM recettes ORDER BY id_recette DESC";
    $all_recipe = mysqli_query($mysqli,$requete);

    if(isset($_GET['search_recipe']) && !empty($_GET['search_recipe'])){
        if(strcmp($_GET['search_recipe'],"tout") != 0){
            $recherche = htmlspecialchars($_GET['search_recipe']);
            $requete = "SELECT * FROM recettes WHERE nom LIKE '%$recherche%' OR ingredients LIKE '%$recherche%' ORDER BY id_recette DESC";
            $all_recipe = mysqli_query($mysqli,$requete);
        }else{
            $recherche = htmlspecialchars($_GET['search_recipe']);
            $requete = "SELECT * FROM recettes ORDER BY nom";
            $all_recipe = mysqli_query($mysqli,$requete);
        }
    }
?>

<body>
    <span id="ariane">
        <a href="aperiton.php">Accueil</a> > recettes </a>
    </span>
    <div class="search_recipes" style="min-height:500px;">
        <h1 style="font-size: 50px;">Résultats pour : 
            <?php
            if(isset($_GET['search_recipe']) && !empty($_GET['search_recipe'])){
                echo $_GET['search_recipe'];
            }
            ?>
        </h1>
        <?php
            if(isset($_GET['search_recipe']) && !empty($_GET['search_recipe'])){
                if( mysqli_num_rows($all_recipe)  > 0){
                    while($recipe = mysqli_fetch_array($all_recipe)){
                        $div = "<a href='recette.php?nom=".$recipe['nom']."'>
                        <div class='search_recipe'>
                        <div class='recipe_photo' ";
                        if($recipe['photo']!=NULL){
                            $div = $div."style='background-image:url(../".$recipe['photo'].");'";
                        }
                        $div = $div."></div>
                        <div class='search_recipe_info'>
                            <h2>". $recipe['nom'] ."</h2>
                            <hr>
                            <p>".$recipe['ingredients']."</p>
                        </div>
                    </div></a>";
                        echo $div;
                    }
                }else{
                    echo "Aucune recette trouvé";
                }
            }
        ?>
    </div>
</body>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
