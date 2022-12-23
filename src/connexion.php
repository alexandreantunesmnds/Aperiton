<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Authentification</title>
    <link rel="stylesheet" href="../css/login.css" media="screen" type="text/css" />
	<link rel="icon" type="image/png" href="../outils/icon.png" />
</head>



<body>
	<div id="body">
		<!-- container div -->
		<div class="container">

			<!-- Boutons slider pour choisir inscription ou connexion -->
			<div class="slider"></div>
			<div class="btn">
				<button class="login">Connexion</button>
				<button class="signup">S'inscrire</button>
			</div>

			<!-- Form section that contains the login and the signup form -->
			<div class="form-section">
				<!-- login form -->
				<form method="post" action="login.php">
					<div class="login-box">
						<input type="text" placeholder="Pseudo" class="utilis ele" name="username" required>
						<input type="password" class="password ele" placeholder="Mot de passe" name="password" required>
						<button type="submit" name="btnLogin" class="clkbtn">C'est parti !</button>
					</div>
					<?php
						if(isset($_GET['erreur'])){
							$err = $_GET['erreur'];
						if($err==1 || $err==2)
							echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
						}
					?>
				</form>


				<!-- signup form -->
				<form method="post" action="register.php">
					<div class="signup-box">
						<div class="sex-box">
							Vous êtes :
							<input type="radio" name="sexe" value="f" selected/> une femme 	
							<input type="radio" name="sexe" value="h"/> un homme
						</div>
						<div class="naiss-box">
							<?php
                                $date = new DateTime(date('Y-m-d'));
                                date_modify($date,'-18 year');
                            ?>
							Date de naissance : <input type="date" name="naissance" max="<?php echo date_format($date,'Y-m-d')?>" title="Vous devez être majeur(e)">
						</div>
						<input type="text" class="name ele" name="nom" placeholder="Nom"  minlength=3 pattern='^[A-Z][\p{L}-]*$' title="Ne peut contenir que des lettres ou de '-'">
						<input type="text" class="prenom ele" name="prenom" placeholder="Prénom" minlength=3 pattern='^[A-Z][\p{L}-]*$' title="Ne peut contenir que des lettres ou de '-'">
						<input type="email" class="email ele" name="mail" placeholder="E-mail" required>
						<input type="text" name="ad" class="adress ele" placeholder="Adresse postale">
						<input type="text" name="cp" class="adress ele" placeholder="Code postal">
						<input type="text" name="ville" class="adress ele" placeholder="Ville">
						<input type="tel" id="phone" name="phone" class="tel ele" placeholder="Numéro de téléphone" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" title="Doit contenir un numero de téléphone valide : 0606060606 ou +33606060606 ou 06-06-06-06-06">
						<input type="text" name="username" class="login ele" placeholder="Pseudo" required pattern="^[a-zA-Z]{1,20}[0-9]{0,3}$">
						<input type="password" class="password ele" name="password" placeholder="Mot de passe" required minlength=8 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins un chiffre, une lettre en majuscule, des lettres en minuscule et doit contenir au moins 8 caractères">
						<input type="password" class="password ele" name="repassword" placeholder="Confirmer le mot de passe" required minlength=8 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins un chiffre, une lettre en majuscule, des lettres en minuscule et doit contenir au moins 8 caractères">
			
						<button type="submit" name="btnRegist" class="clkbtn">Je m'inscris</button>
					</div>
					<?php
						if(isset($_GET['erreur'])){
							$err = $_GET['erreur'];
							if($err==3){
								echo "<p style='color:red'>Le pseudo a déjà été utilisé</p><style>.login{border-color:red;}</style>";
							}
							if($err==4){
								echo "<p style='color:red'>Vous n'avez pas sasie le même mot de passe</p><style>.password {border-color:red;}</style>";
							}
						}
					?>
				</form>
		<script src="../outils/login.js"></script>
</body>
<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
