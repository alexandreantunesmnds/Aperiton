<?php
    session_start();
    if(isset($_POST['username']) && (isset($_POST['password']))){
        //Connexion à la base de donées
        $db = 'Boissons';
        $mysqli=mysqli_connect('localhost', 'root', '',$db) or die("Erreur de connexion");

        $username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));

        if($username !== "" && $password !== ""){ //Si le nom d'utilisateur et le mot de passe ne sont pas vides
            $requete = "SELECT mot_de_passe FROM utilisateur where pseudo = '".$username."'";
            $exec_requete = mysqli_query($mysqli,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $hashed_password = $reponse['mot_de_passe'];

            if(password_verify($password,$hashed_password)){
                $_SESSION['username'] = $username;
                header('Location: aperiton.php');
            }else{
                header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
        }else{
            header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
        }
    }else{
        header('Location: connexion.php');
    }
    mysqli_close($mysqli); // fermer la connexion
?>