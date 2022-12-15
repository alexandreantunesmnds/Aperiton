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
    <!-- <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" /> -->
    <link rel="stylesheet" href="../css/header.css" media="screen" type="text/css" />

    <div id="top">
    <div id="top_left">
    <nav>
    <div class="navbar">
        <div class="container nav-container">
            <input class="checkbox" type="checkbox" name="" id="" />
            <div class="hamburger-lines">
              <span class="line line1"></span>
              <span class="line line2"></span>
              <span class="line line3"></span>
            </div>  
          <div class="menu-items">
            <li><a href="#">Home</a></li>
            <li><a href="#">about</a></li>
            <li><a href="#">blogs</a></li>
            <li><a href="#">portfolio</a></li>
            <li><a href="#">contact</a></li>
          </div>
        </div>
      </div>
    </nav> 
</div>
        <!-- Scripts -->
        <script>
            const menuVerticale = document.querySelector(".menu-verticale")
            const hamburgerButton = document.querySelector(".hamburger-button")

            hamburgerButton.addEventListener('click', () => {
            navLiens.classList.toggle('mobile-menu')
            })
        </script>

        <!-- Barre de recherche -->
        <div id="top_center">
            <a href="aperiton.php"><h2>Aperiton</h2></a>
            <form method="GET">
                <!-- onRealeasKey="" -->
                <input type="search" placeholder="Rechercher une recette" name="search_recipe" >
                <input type="submit" name="Rechercher">
            </form>
            </div>
        <!-- Bouton de connexion et de direction vers la page favoris -->
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
    <!-- La barre de navigation horizontale -->
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