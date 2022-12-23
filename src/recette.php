<!DOCTYPE html>
<html>

<head>
    <title>Aperiton - Page d'accueil</title>
	<meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
    <link rel="icon" type="image/png" href="../outils/icon.png" />
    <script src="https://kit.fontawesome.com/1de3738fce.js" crossorigin="anonymous"></script>
    <script>
function sendAjaxRequest(url) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', url);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log(xhr.responseText);
    }
  }
} </script>
</head>

<!-- L'entête -->
<?php include_once('header.php');   include_once('addToFavourite.php'); ?>
<body>
   <?php
        $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");
        
        if(isset($_GET['nom'])){ 
            $recipe_title = $_GET['nom'];

            /* On recherche la recette dans la bdd */
            $requete = "SELECT id_recette, ingredients, preparation,photo FROM recettes WHERE nom = '$recipe_title'";
            $exec_requete = mysqli_query($mysqli,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
        }
    ?>
    <span id="ariane">
        <a href="aperiton.php">Accueil</a> > recettes > <a href="#"><?php echo $recipe_title; ?></a>
    </span>
    <div id="recipe">
        <div class="recipe">
            <div id="recipe_title" style="align-text:center; text-align: center; margin-top:10px; margin-bottom:10px; display:flex; position: relative; z-index:1;">
                <h1><?php echo $recipe_title; ?></h1>
                <div style="position : absolute; z-index : 2; right:10px;">
                <button id="favorite" class="favorite" id="1"></button>
                <script  type="text/javascript">
$(document).ready(function() {
  $('#favorite').click(function() {
    // Envoi d'une requête AJAX au fichier addToFavorite.php
    $.ajax({
      url: 'addToFavorite.php', // URL de la page PHP qui exécute la fonction addToFavorite
      type: 'POST', // Méthode de soumission des données
      data: { liked: isLiked}, // Données à envoyer au serveur (vous pouvez ajouter ici des variables PHP en utilisant la notation JSON)
      success: function(response) {
        // Mettre à jour l'interface utilisateur en fonction de la réponse du serveur
        if (response == "La recette a été ajoutée à vos favoris") {
          console.log("La recette a été ajoutée aux favoris de l'utilisateur");
          $('#favorite').addClass('liked');
        } else if (response == "La recette a été supprimée de vos favoris") {
          console.log("La recette a été supprimée des favoris de l'utilisateur");
          $('#favorite').removeClass('liked');
        }
    }
});
});
</script>
                    <script type="text/javascript">
                    // Initialisation de la variable isLiked
                        var isLiked = false;
                        document.querySelector('#favorite').addEventListener('click', (e) => {
                            e.currentTarget.classList.toggle('liked');
                            // Inversion de l'état de la variable isLiked
                            isLiked = !isLiked;
                            sendAjaxRequest('addToFavorite.php');
                            });
                            xhr.onreadystatechange = function () {
}
                    </script>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
jQuery(document).ready(function($){
    $('.favorite').click(function(){
        
        });
    });

    // Fonctions de gestion des événements blur, over et out
    function blurCallback() {
        $('<div class="alert alert-info">').html('<?php echo "click"; ?>').appendTo('#consoleDebug').delay(6000).fadeOut();
        fetch("requete.php").then(function(){
            console.log('Requête SQL exécutée avec succès');
        });
    }
    function overCallback(element) {
        // Mémorisation de l'id de l'iframe survollée
        this._overId = $(element).parents('.favorite').attr('id');
    }
    function outCallback(element) {
        // Reset lorsque la souris sort de l'iframe et revient dans la fenêtre
        this._overId = null;
    }
    var _overId = null;
});
                    </script>
                </div>
            </div>
            <style>
                .recipe_photo{    
                    width: 100%;    
                    height: 800px;
                    background-image: url(https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg);
                    margin-right: 20px;
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-size: 100%;
                }
            </style>
            <div class="recipe_photo" style="background-image:url('../<?php if( $reponse['photo']!=NULL)echo $reponse['photo'];?>')">
               <!-- <?php if( $reponse['photo']!=NULL)echo $reponse['photo'];?>-->
            </div>
            <div id="recipe_ingredients" style="margin:10px;">
                <hr>
                <h2>Ingrédients</h2>
                <?php echo $reponse['ingredients']; ?>
            </div>
            <div id="recipe_preparation" style="margin:10px;">
                <hr>
                <h2>Préparation</h2>
                <?php echo $reponse['preparation']; ?>
            </div>
        </div>
    </div>
</body>

<!-- Le pied de page -->
<?php include_once('footer.php'); ?>

</html>
