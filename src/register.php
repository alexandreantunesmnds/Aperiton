<?php
    session_start();

    function verifierAge($birth){
        $aujourdhui = date("Y-m-d");
        $diff = date_diff(date_create($birth), date_create($aujourdhui));
        //echo 'Votre age est '.$diff->format('%y');
        if($diff->format('%y') >= 18){
            $rep = true;
        }
        else{
            $rep = false;
        }
        return $rep;
    }

    if(isset($_POST['username']) && (isset($_POST['password']))){
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
        $login = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['username']));

        
        //On vérifie toute les données
        $conforme = true;

            //On vérifie le pseudo (bdd et conforme)
            $username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['username'])); 
            if(!empty($username)){
                $requete = "SELECT count(*) FROM utilisateur where pseudo = '".$username."'";
                $exec_requete = mysqli_query($mysqli,$requete);
                $reponse = mysqli_fetch_array($exec_requete);
                $count = $reponse['count(*)'];

                if($count !=0){ //Un utilisateur a déjà le même prénom
                    $conforme = false;
                    header('Location: connexion.php?erreur=3');
                }
            }

            //On vérifie les mots de passe
            $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));
            $repassword = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['repassword']));

            if(strcmp($password,$repassword)!=0){
                $conforme = false;
                header('Location: connexion.php?erreur=4');
            }

        //On insere toute les données si celles si sont valides
        if($conforme){
            //On commence par haché son mdp
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $requete = "INSERT INTO `utilisateur`(`sexe`, `nom`, `prenom`, `pseudo`, `mot_de_passe`, `adresse_mail`, `adresse_postale`, `code_pos`, `ville`, `num_tel`, `date_naiss`) VALUES ('".$sex."','".$name."','".$firstname."','".$username."','".$pass."','".$mail."','".$ad."','".$cp."','".$city."','".$phone."','".$birthDate."')";
            mysqli_query($mysqli,$requete);
            $_SESSION['username'] = $username;
            header('Location: aperiton.php');
        }
        mysqli_close($mysqli); // fermer la connexion
    }else{
        header('Location: connexion.php?erreur=15');
    }
?>