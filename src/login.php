<!DOCTYPE html>
<html>

<head>
        <title>Aperiton - Page de connexion</title>
	    <meta charset="utf-8" />
        <!-- Importation du fichier style css -->
        <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
</head>

<body>
    <!-- L'entête -->
    <?php include_once('header.php'); ?>

    <!-- Le corps de page -->
    <div id="body_connexion" >
        <form action="verification.php" method="POST">
            <h1>Connexion</h1>
            
            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

            <input type="submit" id='submit' value='Se connecter' >
            <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                if($err==1 || $err==2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
            ?>

        </form>
    </div>

    <!-- Le pied de page -->
    <?php include_once('footer.php'); ?>
</body>
</html>