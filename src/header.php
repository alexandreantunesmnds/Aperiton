<?php session_start();
    /* Requête permettant la recherche de recette à partir de mots clefs (ingrédients ou nom) */
    /* Code à potentiellement déplacé */
    $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
    $requete = "SELECT * FROM recettes ORDER BY id_recette DESC";
    $all_recipe = mysqli_query($mysqli,$requete);

    if(isset($_GET['search_recipe']) && !empty($_GET['search_recipe'])){
        $recherche = htmlspecialchars($_GET['search_recipe']);
        $requete = "SELECT nom, ingredients FROM recettes WHERE nom LIKE '%$recherche%' OR ingredients LIKE '%$recherche%' ORDER BY id_recette DESC";
        $all_recipe = mysqli_query($mysqli,$requete);
    }
?>
<header>
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />

    <div id="top"> 
        <div id="top_left">
            <a href="aperiton.php"><h2>Aperiton</h2></a>
        </div>
        <div id="top_center">
            <form method="GET">
                <input type="search" placeholder="Rechercher une recette" name="search_recipe" autocomplete="off">
                <input type="submit" name="Rechercher">
            </form>
            </div>
        <div id="top_right">
            <!-- Le cas où l'utilisateur est connu -->
            <?php if(isset($_SESSION['username'])): ?>
                    <button>
                        Mes favoris
                    </button>   
                    <button onclick="window.location.href = 'aperiton.php?deconnexion=true';">
                        Deconnexion
                        <?php 
                            if(isset($_GET['deconnexion'])){ 
                                if($_GET['deconnexion']==true){ 
                                    session_unset();
                                    header("location:aperiton.php");
                                }
                            }
                        ?>
                    </button>
            <!-- Le cas où l'utilisateur est inconnu -->
            <?php else: ?>
                    <button onclick="window.location.href = 'register.php';">
                        Mes favoris
                    </button>   
                    <button onclick="window.location.href = 'register.php';">
                        Connexion
                    </button>
            <?php endif; ?>
        </div>
    </div>
    <!-- La barre de navigation -->
    <nav id="toolbar">
        <a href="page1.html">Toutes nos recettes</a>
        <a href="page2.html">Les recettes par catégories</a>
        <a href="page2.html">Recette au hasard</a>
    </nav>
</header>

<body> <!-- A transférer dans une autre page -->
    <?php
    if(isset($_GET['search_recipe']) && !empty($_GET['search_recipe'])){
        if( mysqli_num_rows($all_recipe)  > 0){
            while($recipe = mysqli_fetch_array($all_recipe)){
                echo $recipe['nom']."\n";
            }
        }else{
            echo "Aucune recette trouvé";
        }
    }
    ?>
</body>