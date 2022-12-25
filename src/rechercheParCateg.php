<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Aperiton - Page de recherche par catégories</title>
    <meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
    <link rel="icon" type="image/png" href="../outils/icon.png" />
    <link rel="stylesheet" href="path/to/font-awesome.css">
</head>

<!-- L'entête -->
<?php include_once('header.php'); ?>

<body>
    <span id="ariane">
        <a href="aperiton.php">Accueil</a> > recettes par catégories </a>
    </span>
    <div style='width:100%;'>
        <?php
             $countSuperCat = 0;

            $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
            $requete = "SELECT DISTINCT nom_super_cat FROM super_categorie ORDER BY nom_super_cat";
            $all_superCateg = mysqli_query($mysqli,$requete);
            while($superCateg = mysqli_fetch_array($all_superCateg)){
                if($countSuperCat==0){
                    echo '<div style="display:flex;margin:10px;">';
                }
                echo '<div style="width:20%;">';
                echo '<h3>'.$superCateg['nom_super_cat'].'</h3>';
                $requete = "SELECT DISTINCT a.nom FROM aliment a, super_cat_par sup, super_categorie su WHERE a.id_aliment = sup.id_aliment AND su.id_super_cat = sup.id_super_cat AND su.nom_super_cat ='".mysqli_real_escape_string($mysqli,htmlspecialchars($superCateg['nom_super_cat']))."' ORDER BY a.nom";
                $all_aliment = mysqli_query($mysqli,$requete);
                while($aliment = mysqli_fetch_array($all_aliment)){
                    echo '>'.$aliment['nom'].'</br>';
                    $requete = "SELECT DISTINCT nom_sous_cat FROM aliment a, sous_cat_par sop, sous_categorie so WHERE a.id_aliment = sop.id_aliment AND so.id_sous_cat = sop.id_sous_cat AND a.nom ='".mysqli_real_escape_string($mysqli,htmlspecialchars($aliment["nom"]))."' ORDER BY nom_sous_cat";
                    $all_sous_cat = mysqli_query($mysqli,$requete);
                    while($sous_cat = mysqli_fetch_array($all_sous_cat)){
                        echo '>>'.$sous_cat['nom_sous_cat'].'</br>';
                    }
                }
                echo '</div>';
                $countSuperCat++;
                if($countSuperCat == 5){
                    echo '</div>';
                    $countSuperCat=0;
                }
            }
        ?>
    </div>
</body>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>