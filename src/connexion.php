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
							Date de naissance : <input type="date" name="naissance">
						</div>
						<input type="text" class="name ele" name="nom" placeholder="Nom">
						<input type="text" class="prenom ele" name="prenom" placeholder="Prénom">
						<input type="email" class="email ele" name="mail" placeholder="E-mail" required>
						<input type="text" name="ad" class="adress ele" placeholder="Adresse postale">
						<input type="text" name="cp" class="adress ele" placeholder="Code postal">
						<input type="text" name="ville" class="adress ele" placeholder="Ville">
						<input type="tel" id="phone" name="phone" class="tel ele" placeholder="Numéro de téléphone">
						<input type="text" name="username" class="login ele" placeholder="Pseudo" required>
						<input type="password" class="password ele" name="password" placeholder="Mot de passe" required>
						<input type="password" class="password ele" name="repassword" placeholder="Confirmer le mot de passe" required>
			
						<button type="submit" name="btnRegist" class="clkbtn">Je m'inscris</button>
					</div>
					<?php
						if(isset($_GET['erreur'])){
							$err = $_GET['erreur'];
						if($err==1 || $err==2)
							echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
						}
					?>
				</form>
		<script src="../outils/login.js"></script>
</body>
<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
