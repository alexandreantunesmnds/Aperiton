<?php
// Connexion à la base de données
$mysqli = mysqli_connect('localhost', 'root', '', 'Boissons') or die("Erreur de connexion");

if (isset($_POST['nom'])) {
    $recipe_title = $_POST['nom'];
    $requete = "SELECT id_recette, ingredients, preparation,photo FROM recettes WHERE nom = ?";
    $stmt = mysqli_prepare($mysqli, $requete);
    mysqli_stmt_bind_param($stmt, "s", $recipe_title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $reponse = mysqli_fetch_array($result);
    $id_recette = $reponse['id_recette'];
  } else {
    // Si aucun nom de recette n'a été fourni, on arrête l'exécution du script
    die("Erreur : aucun nom de recette n'a été fourni");
  }
session_start();
// Vérification si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // Récupération de l'ID de l'utilisateur
    $requete = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = ?";
    $stmt = mysqli_prepare($mysqli, $requete);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $users = mysqli_fetch_array($result);
    $requete = "SELECT COUNT(*) FROM favoris WHERE id_recette = ? AND id_utilisateur = ?";
$stmt = mysqli_prepare($mysqli, $requete);
mysqli_stmt_bind_param($stmt, "ii", $id_recette, $users['id_utilisateur']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = mysqli_fetch_array($result);

if ($count[0] == 0) {
  // Aucune ligne n'existe avec les valeurs spécifiées, on peut insérer une nouvelle ligne
  $requete = "INSERT INTO favoris (id_recette, id_utilisateur) VALUES (?, ?)";
  $stmt = mysqli_prepare($mysqli, $requete);
  mysqli_stmt_bind_param($stmt, "ii", $id_recette, $users['id_utilisateur']);
  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) > 0) {
      // La recette a été ajoutée aux favoris
      echo "La recette a été ajoutée à vos favoris";
  } else {
      // La recette n'a pas pu être ajoutée aux favoris
      echo "Erreur : la recette n'a pas pu être ajoutée à vos favoris";
  }
} else {
  // Une ligne existe déjà avec les valeurs spécifiées, on affiche un message d'erreur ou on ignore la requête
  echo "Erreur : cette recette est déjà dans vos favoris";
}

} else {
// L'utilisateur n'est pas connecté, on affiche un message d'erreur
echo "Erreur : vous devez être connecté pour ajouter une recette à vos favoris";
}
