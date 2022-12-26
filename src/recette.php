<?php include_once('header.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Aperiton - Page d'accueil</title>
	<meta charset="utf-8" />
    <!-- Importation du fichier style css -->
    <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
    <link rel="icon" type="image/png" href="../outils/icon.png" />
    <script src="https://kit.fontawesome.com/1de3738fce.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<body>
   <?php
                                       $host = 'localhost';
            $user = 'id20059208_boissons';
            $password = 'bLEr~9qr(I]\awtD'; // remplacez ce mot de passe par celui de votre base de données
            $database = 'id20059208_boisson';
            
            // Création de la connexion
            $mysqli = mysqli_connect($host, $user, $password, $database);
        
           if(isset($_GET['nom'])){ 
               $recipe_title = $_GET['nom'];
   
               /* On recherche la recette dans la bdd */
               $requete = "SELECT id_recette, ingredients, preparation,photo FROM recettes WHERE nom = '$recipe_title'";
               $exec_requete = mysqli_query($mysqli,$requete);
               $reponse = mysqli_fetch_array($exec_requete);
   
                 // Sélection de l'ID de la recette avec le nom correspondant
               $sql = "SELECT id_recette FROM recettes WHERE nom = '$recipe_title'";
               $result = mysqli_query($mysqli, $sql);
               $result = mysqli_fetch_array($result);
   
               // Récupération de l'ID de la recette
               $recipe_id = $result['id_recette'];
           }
           if (isset($_SESSION['username'])) {
             $username = $_SESSION['username']; // ID de l'utilisateur connecté

            // Sélection de l'ID de l'utilisateur avec le nom correspondant
            $sql = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$username'";
            $result = mysqli_query($mysqli, $sql);
            $result = mysqli_fetch_array($result);

            // Récupération de l'ID de l'utilisateur
            $user_id = $result['id_utilisateur'];
   
             // On vérifie si l'utilisateur a déjà mis la recette en favoris
             $sql = "SELECT COUNT(*) as count FROM favoris WHERE id_utilisateur = '$user_id' AND id_recette = '$recipe_id'";
             $result = mysqli_query($mysqli, $sql);
             $result = mysqli_fetch_array($result);
           }
           else{
            $result['count']=0;
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
                <?php  if (isset($_SESSION['username'])) {?>
                <button id="favorite" class="favorite <?php if ($result['count'] == 1) echo 'liked'; ?>" id="1"></button>
                <?php }
                else{
                    ?>
                <button id="favorite" class="favorite" disabled id="1"></button>
                <?php   echo '<p  class="message-favoris">Vous devez être connecté pour ajouter cette recette à vos favoris</p>';}?>
 
                    <script type="text/javascript">
                        // Initialisation de la variable isLiked
                        var isLiked = <?php if ($result['count'] == 1) echo 'true'; else echo 'false';?>;

// Ajout d'un écouteur d'événement click sur le bouton
document.getElementById('favorite').addEventListener('click', (e) => {
  // Inversion de la valeur de isLiked
  isLiked = !isLiked;
  e.currentTarget.classList.toggle('liked');

  // Envoi d'une requête AJAX au fichier addToFavorite.php ou removeToFavorite.php en fonction de la valeur de isLiked
  $.ajax({
    url: isLiked ? 'addToFavourite.php' : 'removeToFavourite.php',
    type: 'POST',
    data: { liked: isLiked,  nom: <?php echo json_encode($recipe_title); ?> },
    success: function(response) {
      console.log(response);
      // Mettre à jour l'interface utilisateur en fonction de la réponse du serveur
    },
    error: function(xhr, status, error) {
      console.error(error);
      // Afficher un message d'erreur à l'utilisateur
    }
  });
});
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
