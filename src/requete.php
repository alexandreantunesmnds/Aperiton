<?php
    include("http://jpconnexion.free.fr/include_php/read_parametre3.inc");

    function addToFavorite(){
        $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
        $requete = "SELECT id_recette, ingredients, preparation,photo FROM recettes WHERE nom = '$recipe_title'";
        $exec_requete = mysqli_query($mysqli,$requete);
    }
?>