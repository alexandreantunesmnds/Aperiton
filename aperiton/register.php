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
	<header>
		<h1 class="heading">Aperiton</h1>
		<h3 class="title">Veuillez créer un compte ou vous connecter</h3>
	</header>

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
			<div class="login-box">
            <input type="text" placeholder="Entrez le nom d'utilisateur" class="utilis ele"
                name="username" required>
				<input type="password"
					class="password ele"
					placeholder="Entrez le mot de passe" required>
				<button class="clkbtn">C'est parti !</button>
			</div>

			<!-- signup form -->
			<div class="signup-box">
				<input type="text"
					class="name ele"
					placeholder="Enter your name">
				<input type="email"
					class="email ele"
					placeholder="youremail@email.com">
				<input type="password"
					class="password ele"
					placeholder="password">
				<input type="password"
					class="password ele"
					placeholder="Confirm password">
				<button class="clkbtn">Je m'inscris</button>
			</div>
		</div>
	</div>
	<script src="../outils/login.js"></script>
</body>

</html>
