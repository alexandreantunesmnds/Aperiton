<?php
    session_start();

    function verifierDateEtAge($birth){
        // date aujourd'hui
        $date = new DateTime();
        // date - 18 ans
        $date_18 = $date->sub(new DateInterval('P18Y'));
        // si $_POST['date_naissance'] est au format jj-mm-yyyy, par exemple = 25-12-2001 on le converti au format dateTime avec DateTime::createFromFormat
        $birth = DateTime::createFromFormat('j-m-Y', $birth);
        if($birth >= $date_18){
            return true;
        }
        else{
            return false;
        }
    }

    if(isset($_POST['username']) && (isset($_POST['password']))){
        //Connexion à la base de donées
        $db = 'Boissons';
        $mysqli=mysqli_connect('localhost', 'root', '',$db) or die("Erreur de connexion");

        $username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));

        //On récupère toute autre données
        $sex = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['sexe']));
        $repassword = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['repassword']));
        $birth = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['naissance']));
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
            if(!empty($login) && !preg_match("/^[A-Z][\p{L}-]*$/", $login)){
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
            if(!empty($birth) && !verifierDateEtAge($birth)){
                $conforme = false;
                header('Location: connexion.php?erreur=3');
            }

            //On vérifie le nom
            if(!empty($name) && !preg_match('/^[A-Z][\p{L}-]*$/', $name)){
                $conforme = false;
                header('Location: connexion.php?erreur=4');
            }

            //On vérifie le prénom
            if(!empty($firstname) && !preg_match('/^[A-Z][\p{L}-]*$/', $firstname)){
                $conforme = false;
                header('Location: connexion.php?erreur=5');
            }

            //On vérifie l'adresse mail
            if (!empty($mail) && !preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $mail )){
                $conforme = false;
                header('Location: connexion.php?erreur=6');
            }

            //On vérifie l'adresse postal
            if(!empty($ad) && !preg_match('([0-9]*) ?([a-zA-Z,\. ]*) ?([0-9]{5}) ?([a-zA-Z]*', $ad)){
                $conforme = false;
                header('Location: connexion.php?erreur=7');
            }

            //On vérifie le code postal
            if(!empty($cp) && !preg_match('^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$', $cp)){
                $conforme = false;
                header('Location: connexion.php?erreur=8');
            }

            //On vérifie le nom de la ville
            if(!empty($city) && !preg_match("^[a-zA-Z]([-' ]?[a-zA-Z])*$", $city)){
                $conforme = false;
                header('Location: connexion.php?erreur=9');
            }

            //On vérifie le numéro de téléphone
            if (!empty($phone) && !preg_match ( " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# " , $phone ) ){
                $conforme = false;
                header('Location: connexion.php?erreur=10');
            }

        //On insere toute les données si celles si sont valides
        if($conforme){
            //On commence par haché son mdp
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $requete = "INSERT INTO `utilisateur`(`sexe`, `nom`, `prenom`, `pseudo`, `mot_de_passe`, `adresse_mail`, `adresse_postale`, `code_pos`, `ville`, `num_tel`, `date_naiss`) VALUES ('".$sex."','".$name."','".$firstname."','".$login."','".$pass."','".$mail."','".$ad."','".$cp."','".$city."','".$phone."','".$birth."')";
            mysqli_query($mysqli,$requete);
            $_SESSION['username'] = $username;
            header('Location: aperiton.php');
        }
        mysqli_close($mysqli); // fermer la connexion
    }else{
        header('Location: connexion.php?erreur=15');
    }
?>