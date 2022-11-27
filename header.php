<?php session_start();?>
<header>
    <div id="top"> 
        Aperiton
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
                <button onclick="window.location.href = 'login.php';">
                    Mes favoris
                </button>   
                <button onclick="window.location.href = 'login.php';">
                    Connexion
                </button>
        <?php endif; ?>
    </div>
    <!-- La barre de navigation -->
    <nav id="toolbar">
        <a href="page1.html">Toutes nos recettes</a>
        <a href="page2.html">Recette au hasard</a>
    </nav>
</header>