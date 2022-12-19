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
				<input type="text" placeholder="Pseudo" class="utilis ele"
					name="username" required>
					<input type="password"
						class="password ele"
						placeholder="Mot de passe" name="password" required>
					<button type="submit" name="btnLogin" class="clkbtn">C'est parti !</button>
				</div>
				<?php
				if (isset($_POST['btnLogin'])) {
				// Check if the username and password are correct
				// If they are, redirect the user to the homepage
				  // Récupération des valeurs du formulaire
				$username = $_POST['username'];
				$password = $_POST['password'];
				// Connexion à la base de données
  				$mysqli = mysqli_connect('localhost', 'root', '', 'boissons');
				$query = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$username' AND mot_de_passe = '$password'";
  				$result = mysqli_query($mysqli, $query);
  				$row = mysqli_fetch_array($result);
				  // Si l'utilisateur a été trouvé dans la base de données
  				if ($row) {
   				// Enregistrez l'ID de l'utilisateur dans une variable de session
					// Démarrage de la session et enregistrement des informations de connexion dans la session
					session_start();
    				$_SESSION['user_id'] = $row['id_utilisateur'];
 				}
				// Vérification des informations de connexion dans la base de données
				$query = "SELECT * FROM utilisateur WHERE pseudo='$username' AND mot_de_passe='$password'";
				$result = mysqli_query($mysqli, $query);
				if (mysqli_num_rows($result) > 0) {
					$_SESSION['username'] = true;
				
					// Redirection de l'utilisateur vers la page d'accueil
					header('Location: aperiton.php');
					exit;
				  } else {
					// Si les informations de connexion sont incorrectes, affichage d'un message d'erreur
					echo '<p>Le nom d\'utilisateur est incorrect !</p>';				  }
				}
				?>
				</form>


					<!-- signup form -->
					<form method="post">
					<div class="signup-box">
					<div class="sex-box">
					Vous êtes :
					<input type="radio" name="sexe" value="f"/> une femme 	
					<input type="radio" name="sexe" value="h"/> un homme
					</div>
					<div class="naiss-box">
						Date de naissance : 
						<input type="date" name="naissance">
					</div>
						<input type="text"
							class="name ele"
							name="nomtxt"
							placeholder="Nom">
						<input type="text"
						class="prenom ele"
						name="prenomtxt"
						placeholder="Prénom">
						<input type="email"
							class="email ele"
							name="mailtxt"
							placeholder="E-mail">
						<input type="text" name="ad_post" class="adress ele"
							placeholder="Adresse postale">
						<input type="text" name="cp_post"
							class="adress ele"
							placeholder="Code postale">
						<input type="text" name="ville" class="adress ele"
							placeholder="Ville">
						<input type="tel" id="phone" name="phone" class="tel ele" placeholder="Numéro de téléphone">
						<input type="text" name="logintxt"required="required" class="login ele" placeholder="Pseudo">
						<input type="password"
							class="password ele"
							name="motdepassetxt"
							placeholder="Mot de passe">
						<input type="password"
							class="password ele"
							placeholder="Confirmer le mot de passe">
			
						<button type="submit" name="btnRegist" class="clkbtn">Je m'inscris</button>
					</div>
					</form>
					
					<?php
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						if (isset($_POST['btnRegist'])) {
							$mysqli=mysqli_connect('127.0.0.1', 'root', '','Boissons') or die("Erreur de connexion");
							$sexe = $_POST['sexe'];
							$nom = $_POST['nomtxt'];
							$prenom = $_POST['prenomtxt'];
							$datenaiss = $_POST['naissance'];
							$mail = $_POST['mailtxt'];
							$adresse = $_POST['ad_post'];
							$codepo = $_POST['cp_post'];
							$ville = $_POST['ville'];
							$tel = $_POST['phone'];
							$utilisateur = $_POST['logintxt'];
							$motdepasse = $_POST['motdepassetxt'];
							$sql = "INSERT INTO utilisateur (sexe,nom,prenom,pseudo,mot_de_passe,adresse_mail,adresse_postale,code_pos,ville,num_tel,date_naiss) 
							VALUES ('$sexe', '$nom', '$prenom', '$utilisateur', '$motdepasse','$mail','$adresse','$codepo','$ville','$tel',$datenaiss);";
							$run = mysqli_query($mysqli, $sql);
							mysqli_close($mysqli);
						}
					}
					?>

		<script src="../outils/login.js"></script>
</body>
<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
