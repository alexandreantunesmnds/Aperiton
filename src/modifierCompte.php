<?php
    session_start();

    if(isset($_POST['mail'])){
        //Connexion à la base de donées
        $db = 'Boissons';
        $mysqli=mysqli_connect('localhost', 'root', '',$db) or die("Erreur de connexion");

        

        //On déclare toutes nos variables
        $sex = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['sexe']));
        $birthDate = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['naissance']));
        $name = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['nom']));
        $firstname = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['prenom']));
        $mail = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['mail']));
        $ad = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['ad']));
        $cp = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['cp']));
        $city = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['ville']));
        $phone = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['phone']));
        
        //On vérifie toute les données
        $conforme = true;

            //On vérifie les mots de passe
            $oldPassword = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['oldPassword']));
            $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));
            $repassword = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['repassword']));

            $requete = "SELECT mot_de_passe FROM utilisateur where pseudo = '".$_SESSION['username']."'";
            $exec_requete = mysqli_query($mysqli,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $hashed_password = $reponse['mot_de_passe'];

            if(password_verify($oldPassword,$hashed_password)){
                if(strcmp($password,$repassword)!=0){
                    $conforme = false;
                    header('Location: profil.php?erreur=1');
                }
            }else{
                $conforme = false;
                header('Location: profil.php?erreur=2');
            }
            

        //On insere toute les données si celles si sont valides
        if($conforme){
            //On commence par haché son mdp
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $requete = "UPDATE `utilisateur` SET sexe ='".$sex."',nom='".$name."',prenom='".$firstname."',mot_de_passe='".$pass."',adresse_mail='".$mail."',adresse_postale='".$ad."', code_pos='".$cp."',ville='".$city."',num_tel='".$phone."',date_naiss='".$birthDate."' WHERE pseudo = '".$_SESSION['username']."'";
            mysqli_query($mysqli,$requete);
            header('Location: profil.php');
        }
        mysqli_close($mysqli); // fermer la connexion
    }else{
        header('Location: profil.php?erreur=3');
    }
?>