<?php
    include("http://jpconnexion.free.fr/include_php/read_parametre3.inc");

    function addToFavorite(){
                                   $host = 'localhost';
            $user = 'id20059208_boissons';
            $password = 'bLEr~9qr(I]\awtD'; // remplacez ce mot de passe par celui de votre base de données
            $database = 'id20059208_boisson';
            
            // Création de la connexion
            $mysqli = mysqli_connect($host, $user, $password, $database);
        $requete = "SELECT id_recette, ingredients, preparation,photo FROM recettes WHERE nom = '$recipe_title'";
        $exec_requete = mysqli_query($mysqli,$requete);
    }
?>