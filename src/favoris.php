<?php include_once('header.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Aperiton - Mes favoris</title>
	<meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
    <link rel="icon" type="image/png" href="../outils/icon.png" />
</head>

<?php if(isset($_SESSION['username'])): ?>
<!-- Corps de page -->
<body>
<span id="ariane">
        <a href="aperiton.php">Accueil</a> > recettes </a>
    </span>
    <div class="search_recipes" style="min-height:500px;">
        <h1 style="font-size: 50px;">Mes favoris : </h1>
        <?php
                                    $host = 'localhost';
            $user = 'id20059208_boissons';
            $password = 'bLEr~9qr(I]\awtD'; // remplacez ce mot de passe par celui de votre base de données
            $database = 'id20059208_boisson';
            
            // Création de la connexion
            $mysqli = mysqli_connect($host, $user, $password, $database);
            $requete = "SELECT id_utilisateur FROM utilisateur WHERE pseudo LIKE '".$_SESSION['username']."'";
            $all_users = mysqli_query($mysqli,$requete); //On récupère l'id de l'utilisateur
            if( mysqli_num_rows($all_users)  > 0){
                $user = mysqli_fetch_array($all_users);

                //Puis ses recettes favoris
                $requete = "SELECT r.nom, r.photo, r.ingredients FROM recettes r, favoris f, utilisateur u WHERE r.id_recette = f.id_recette AND u.id_utilisateur = f.id_utilisateur AND u.id_utilisateur = " . $user['id_utilisateur'];
                $all_recipe = mysqli_query($mysqli,$requete);

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
<?php else: ?>
    <?php header('Location: connexion.php');?>
<?php endif; ?>


<!-- Le pied de page -->
<?php include_once('footer.php'); ?>
</html>