<?php
    session_start();
    if(isset($_POST['username']) && (isset($_POST['password']))){
        //Connexion à la base de donées
        $db = 'Boissons';
        $mysqli=mysqli_connect('localhost', 'root', '',$db) or die("Erreur de connexion");

        $username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));

        if($username !== "" && $password !== ""){ //Si le nom d'utilisateur et le mot de passe ne sont pas vides
            $requete = "SELECT count(*) FROM utilisateur where pseudo = '".$username."' AND mot_de_passe = '".$password."' ";
            $exec_requete = mysqli_query($mysqli,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];

            if($count !=0){ //L'utilisateur a été trouvé
                $_SESSION['username'] = $username;
                header('Location: aperiton.php');
            }else{
                //header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
        }else{
            //header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
        }
    }else{
        header('Location: login.php');
    }
    mysqli_close($db); // fermer la connexion
?>