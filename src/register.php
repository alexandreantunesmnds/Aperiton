<?php
    session_start();

    function verifierAge($birth){
        $dateNaissance = "15-06-1995";
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
        $sex;
        $username;
        $password;
        $repassword;
        $birth;
        $name;
        $firstname;
        $phone;
        $mail;
        $ad;
        $cp;
        $city;
        
        //On vérifie toute les données
        $conforme = true;

            //On vérifie le sexe
            if(isset($_POST['sexe'])){
                $sex = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['sexe']));
            }

            //On vérifie le pseudo (bdd et conforme)
            $username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['username'])); 
            if(!empty($username) && !preg_match("/^[A-Z][\p{L}-]*$/", $username)){
                $requete = "SELECT count(*) FROM utilisateur where pseudo = '".$username."'";
                $exec_requete = mysqli_query($mysqli,$requete);
                $reponse = mysqli_fetch_array($exec_requete);
                $count = $reponse['count(*)'];

                if($count !=0){ //Un utilisateur a déjà le même prénom
                    $conforme = false;
                    header('Location: connexion.php?erreur=11');
                }
            }

            //On vérifie les mots de passe
            $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));
            $repassword = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['repassword']));

            if(strcmp($password,$repassword)!=0){
                $conforme = false;
                header('Location: connexion.php?erreur=12');
            }else{
                if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$password)){
                    $conforme = false;
                    header('Location: connexion.php?erreur=13');
                }
            }

            //On vérifie la date de naissance
            if(isset($_POST['naissance'])){
                $birth = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['naissance']));
                if(!empty($birth) && verifierAge($birth)==false){
                    $conforme = false;
                    header('Location: connexion.php?erreur=3');
                }else{
                    $timestamp = strtotime($birth); 
                    $birthDate =    date("Y-m-d", $timestamp );
                }
            }

            //On vérifie le nom
            if(isset($_POST['nom'])){
                $name = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['nom']));
                if(!empty($name) && !preg_match('/^[A-Z][\p{L}-]*$/', $name)){
                    $conforme = false;
                    header('Location: connexion.php?erreur=4');
                }
            }

            //On vérifie le prénom
            if(isset($_POST['prenom'])){
                $firstname = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['prenom']));
                if(!empty($firstname) && !preg_match('/^[A-Z][\p{L}-]*$/', $firstname)){
                    $conforme = false;
                    header('Location: connexion.php?erreur=5');
                }
            }

            //On vérifie l'adresse mail
            if(isset($_POST['mail'])){
                $mail = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['mail']));
                if (!empty($mail) && !preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $mail )){
                    $conforme = false;
                    header('Location: connexion.php?erreur=6');
                }
            }

            //On vérifie l'adresse postal
            if(isset($_POST['ad'])){
                $ad = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['ad']));
                /*if(!empty($ad)){
                    $conforme = false;
                    header('Location: connexion.php?erreur=7');
                }*/
            }

            //On vérifie le code postal
            if(isset($_POST['cp'])){
                $cp = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['cp']));
                if(!empty($cp) && !preg_match('/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/', $cp)){
                    $conforme = false;
                    header('Location: connexion.php?erreur=8');
                }
            }

            //On vérifie le nom de la ville
            if(isset($_POST['ville'])){
                $city = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['ville']));
                if(!empty($city) && !preg_match("/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/", $city)){
                    $conforme = false;
                    header('Location: connexion.php?erreur=9');
                }
            }

            //On vérifie le numéro de téléphone
            if(isset($_POST['phone'])){
                $phone = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['phone']));
                if (!empty($phone) && !preg_match ( "/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/" , $phone ) ){
                    $conforme = false;
                    header('Location: connexion.php?erreur=10');
                }
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