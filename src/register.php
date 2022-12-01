<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width,
						initial-scale=1.0">
	<title>Authentification</title>
    <link rel="stylesheet" href="../css/login.css" media="screen" type="text/css" />
</head>

<!-- L'entête -->
<?php include_once('header.php'); ?>

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

			<!-- Form section that contains the
				login and the signup form -->
			<div class="form-section">

				<!-- login form -->
				<form method="post">
				<div class="login-box">
				<input type="text" placeholder="Entrez le nom d'utilisateur" class="utilis ele"
					name="username" required>
					<input type="password"
						class="password ele"
						placeholder="Entrez le mot de passe" required>
					<button type="submit" name="btnLogin" class="clkbtn">C'est parti !</button>
				</div>
				</form>

					<!-- signup form -->
					<form method="post">
					<div class="signup-box">
					<div class="sex-box">
					Vous êtes :
					<input type="radio" name="sexe" value="f"/> une femme 	
					<input type="radio" name="sexe" value="h"/> un homme
					</div>
						<input type="text"
							class="name ele"
							placeholder="Entrez votre nom">
						<input type="text"
						class="prenom ele"
						placeholder="Entrez votre prénom">
						<input type="email"
							class="email ele"
							placeholder="adressemail@email.com">
						<input type="text" name="ad_post" class="adress ele"
							placeholder="Entrez votre adresse postale">
						<input type="text" name="cp_post"
							class="adress ele"
							placeholder="Entrez votre code postale">
						<!--<input type="text" name="ville" class="adress ele"
							placeholder="Entrez votre ville">
						<input type="tel" id="phone" name="phone" class="tel ele" placeholder="0788023498"
						pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">-->
						<input type="text" required="required" class="login ele" placeholder="Login">
						<input type="password"
							class="password ele"
							placeholder="Entre ton mot de passe">
						<input type="password"
							class="password ele"
							placeholder="Confirmer le mot de passe">
			
						<button type="submit" name="btnRegist" class="clkbtn">Je m'inscris</button>
					</form>
					
					<?php
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						if (isset($_POST['btnRegist'])) {
							$sqlquery = "INSERT INTO table VALUES
							('John', 'Doe', 'john@example.com')";
						}
					}
					?>

				</div>
			</div>
		</div>
		<script src="../outils/login.js"></script>
	</div>
</body>
<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
