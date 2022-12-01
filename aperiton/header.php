<?php session_start();?>
<header>
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../style.css" media="screen" type="text/css" />

    <div id="top"> 
        <div id="top_left">
            <a href="aperiton.php"><h2>Aperiton</h2></a>
        </div>
        <div id="top_center">
            <input type="text" placeholder="Rechercher une recette" name="recipeResearch" required>
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
                    <button onclick="window.location.href = 'aperiton/login.php';">
                        Mes favoris
                    </button>   
                    <button onclick="window.location.href = 'aperiton/login.php';">
                        Connexion
                    </button>
            <?php endif; ?>
        </div>
    </div>
    <!-- La barre de navigation -->
    <nav id="toolbar">
        <a href="page1.html">Toutes nos recettes</a>
        <a href="page2.html">Recette au hasard</a>
    </nav>
</header>