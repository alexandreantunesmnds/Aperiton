<?php include_once('header.php'); ?>
<?php
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: connexion.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Aperiton - Page de profile</title>
	<meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
    <link rel="icon" type="image/png" href="../outils/icon.png" />
    <script src="https://kit.fontawesome.com/1de3738fce.js" crossorigin="anonymous"></script>
</head>

<?php if(isset($_SESSION['username'])): ?>
    <body>
        <span id="ariane">
            <a href="aperiton.php">Accueil</a> > profil
            <div class="monProfil">
                <?php
                            $host = 'localhost';
            $user = 'id20059208_boissons';
            $password = 'bLEr~9qr(I]\awtD'; // remplacez ce mot de passe par celui de votre base de données
            $database = 'id20059208_boisson';
            
            // Création de la connexion
            $mysqli = mysqli_connect($host, $user, $password, $database);
                    $requete = "SELECT * FROM utilisateur WHERE pseudo LIKE '".$_SESSION['username']."'";
                    $all_users = mysqli_query($mysqli,$requete);
                    $user = mysqli_fetch_array($all_users);
                ?>
                <!-- signup form -->
				<form method="post" action="modifierCompte.php">
                    <div class="monCompte">
                        <h2>Mon compte :</h2>
                        <div class="sex-box">
                            <p>Vous êtes :
                                <input type="radio" name="sexe" value="f" <?php if($user['sexe'] == "f") echo "checked"?>/> une femme 	
                                <input type="radio" name="sexe" value="h"<?php if($user['sexe'] == "h") echo "checked"?>/> un homme
                            </p>
                        </div>
                            <p>Nom : <input id="input" type="text" class="name" name="nom" placeholder="Nom" value="<?php echo $user['nom'] ?>" minlength=3 pattern='^[A-Z][\p{L}-]*$' title="Ne peut contenir que des lettres ou de '-'"></p>
                            <p>Prenom : <input id="input" type="text" class="prenom" name="prenom" placeholder="Prénom"value="<?php echo $user['prenom'] ?>" minlength=3 pattern='^[A-Z][\p{L}-]*$' title="Ne peut contenir que des lettres ou de '-'"></p>
                        <div class="naiss-box">
                            <?php
                                $date = new DateTime(date('Y-m-d'));
                                date_modify($date,'-18 year');
                            ?>
                            <p>Date de naissance : <input type="date" name="naissance" value="<?php echo $user['date_naiss'] ?>" max="<?php echo date_format($date,'Y-m-d')?>" title="Vous devez être majeur(e)"></p>
                        </div>
                    </div>
                    <div class="mesIdentifiants">
                        <h2>Mes identifiants :</h2>
                        <p>Pseudo : <input id="input" type="text" disabled="disabled" name="username" class="pseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'] ?>" title="Vous ne pouvez pas modifier votre pseudo"></p>
                        <h3>Modifier mon mot de passe :</h3>
                        <p>
                            <input id="input" type="password" class="password" name="oldPassword" placeholder="Ancien mot de passe" minlength=8 title="Votre ancien mot de passe">
                            <input id="input" type="password" class="password" name="password" placeholder="Nouveau mot de passe" minlength=8 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins un chiffre, une lettre en majuscule, des lettres en minuscule et doit contenir au moins 8 caractères">
                            <input id="input" type="password" class="password" name="repassword" placeholder="Confirmer nouveau mot de passe" minlength=8 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins un chiffre, une lettre en majuscule, des lettres en minuscule et doit contenir au moins 8 caractères">
                        </p>
                        <?php if(isset($_GET['erreur'])){
                                $err = $_GET['erreur'];

                                if($err==1){
                                    echo "<p style='color:red'>Les mots de passe saisies sont différents</p>";
                                }else if($err == 2){
                                    echo "<p style='color:red'>Mot de passe incorrect</p>";
                                }
                            }
                        ?>
                    </div>
                    <div class="mesCoordonnees">
                        <h2>Mes coordonnées :</h2>
                        <p> Adresse email : <input style="width:300px;" id="input" type="email" class="email ele" name="mail" placeholder="E-mail"  value="<?php echo $user['adresse_mail'] ?>"></p>
                        <p>Numéro de téléphone : <input style="width:150px;" id="input" type="tel" id="phone" name="phone" class="tel ele" placeholder="Numéro de téléphone"  value="<?php echo $user['num_tel'] ?>" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" title="Doit contenir un numero de téléphone valide : 0606060606 ou +33606060606 ou 06-06-06-06-06"></p>
                        <p>Adresse postale : <input style="width:400px;" id="input" type="text" name="ad" class="adress" placeholder="Adresse postale" value="<?php echo $user['adresse_postale'] ?>"></p>
                        <p>Code postale : <input style="width:100px;" id="input" type="text" name="cp" class="adress" placeholder="Code postal" value="<?php echo $user['code_pos'] ?>" pattern="^(([0-8][0-9])|(9[0-5]))[0-9]{3}$" title="Ne prend en compte que les codes postales français"></p>
                        <p>Ville : <input style="width:300px;" id="input" type="text" name="ville" class="adress" placeholder="Ville" value="<?php echo $user['ville'] ?>" pattern="^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$"></p>
                    </div>
                    <div class="validerChangement">
                        <button type="submit" name="btnRegist" class="clkbtn">Sauvegarder les modifications</button>
                    </div>
				</form>
            </div>
        </span>
    </body>
<?php endif; ?>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>