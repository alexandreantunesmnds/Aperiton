<?php // Creation de la base de donnees 
	//On réucpère les données depuis le fichier donnees.inc.php
	include_once("Donnees.inc.php");

	function query($link,$requete)
	{ 
		$resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
		return($resultat);
	}
   
  
   //On se connecte à la base de donnée
   $base="Boissons";
	$mysqli=mysqli_connect('127.0.0.1', 'root', '',$base) or die("Erreur de connexion");
   //On crée la base de donnée
	$Sql="
		DROP DATABASE IF EXISTS $base;
		CREATE DATABASE $base;
		USE $base;
		CREATE TABLE utilisateur(
            id_utilisateur INT NOT NULL AUTO_INCREMENT,
            sexe VARCHAR(50),
            nom VARCHAR(50),
            prenom VARCHAR(50),
            pseudo VARCHAR(50) NOT NULL,
            mot_de_passe VARCHAR(100) NOT NULL,
            adresse_mail VARCHAR(50),
            adresse_postale VARCHAR(50),
            code_pos VARCHAR(50),
            ville VARCHAR(50),
            num_tel VARCHAR(50),
            date_naiss DATE,
            PRIMARY KEY(id_utilisateur)
         );
         
         CREATE TABLE recettes(
            id_recette INT NOT NULL AUTO_INCREMENT,
            nom VARCHAR(200),
            ingredients VARCHAR(500),
            preparation VARCHAR(500),
            photo VARCHAR(255) NULL,
            PRIMARY KEY(id_recette)
         );
         
         CREATE TABLE aliment(
            id_aliment INT NOT NULL AUTO_INCREMENT,
            nom VARCHAR(50),
            PRIMARY KEY(id_aliment)
         );
         
         CREATE TABLE super_categorie(
            id_super_cat INT NOT NULL AUTO_INCREMENT,
            nom_super_cat VARCHAR(50),
            PRIMARY KEY(id_super_cat)
         );
         
         CREATE TABLE sous_categorie(
            id_sous_cat INT NOT NULL AUTO_INCREMENT,
            nom_sous_cat VARCHAR(50),
            PRIMARY KEY(id_sous_cat)
         );
         
         CREATE TABLE favoris(
            id_utilisateur INT,
            id_recette INT,
            PRIMARY KEY(id_utilisateur, id_recette),
            FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
            FOREIGN KEY(id_recette) REFERENCES recettes(id_recette)
         );
         
         CREATE TABLE contient(
            id_recette INT,
            id_aliment INT,
            PRIMARY KEY(id_recette, id_aliment),
            FOREIGN KEY(id_recette) REFERENCES recettes(id_recette),
            FOREIGN KEY(id_aliment) REFERENCES aliment(id_aliment)
         );
         
         CREATE TABLE super_cat_par(
            id_aliment INT,
            id_super_cat INT,
            PRIMARY KEY(id_aliment, id_super_cat),
            FOREIGN KEY(id_aliment) REFERENCES aliment(id_aliment),
            FOREIGN KEY(id_super_cat) REFERENCES super_categorie(id_super_cat)
         );
         
         CREATE TABLE sous_cat_par(
            id_aliment INT,
            id_sous_cat INT,
            PRIMARY KEY(id_aliment, id_sous_cat),
            FOREIGN KEY(id_aliment) REFERENCES aliment(id_aliment),
            FOREIGN KEY(id_sous_cat) REFERENCES sous_categorie(id_sous_cat)
         );";

		//On parcout chaque aliment
		foreach($Hierarchie as $Aliment => $Categories){
         //On écrit la requête pour l'aliment qu'on parcourt
         $requet = sprintf("INSERT INTO `aliment` (`nom`) VALUES('%s');",mysqli_real_escape_string($mysqli,$Aliment));
         //echo $requet."<br>";
         $Sql = $Sql.$requet;

         //On parcourt chaque sous-cat après avoir vérifier qu'il existe
         if(array_key_exists("sous-categorie", $Categories)){
            foreach($Categories['sous-categorie'] as $sous_cat){
               //On écrit la requête pour ajouter la sous_cat
               $requet = sprintf("INSERT INTO `sous_categorie` (`nom_sous_cat`) VALUES('%s');",mysqli_real_escape_string($mysqli,$sous_cat));
               //echo $requet."<br>";
               $Sql = $Sql.$requet;

               //On écrit la requête pour associer l'aliment à la sous_cat
               $requet = sprintf("INSERT INTO `sous_cat_par`(`id_aliment`, `id_sous_cat`) VALUES ((SELECT id_aliment FROM aliment WHERE nom LIKE '%s' LIMIT 1),(SELECT id_sous_cat FROM sous_categorie WHERE nom_sous_cat LIKE '%s' LIMIT 1));",
               mysqli_real_escape_string($mysqli,$Aliment),mysqli_real_escape_string($mysqli,$sous_cat));
               $Sql = $Sql.$requet;
            }
         }
      
         //On parcourt chaque sueper-cat après avoir vérifier qu'il existe
         if(array_key_exists("super-categorie", $Categories)){
            foreach($Categories['super-categorie'] as $super_cat){
               //On écrit la requête pour ajouter la super_cat
               $requet = sprintf("INSERT INTO `super_categorie` (`nom_super_cat`) VALUES('%s');",mysqli_real_escape_string($mysqli,$super_cat));
               //echo $requet."<br>";
               $Sql = $Sql.$requet;

               //On écrit la requête pour associer l'aliment à la sous_cat
               $requet = sprintf("INSERT INTO `super_cat_par`(`id_aliment`, `id_super_cat`) VALUES ((SELECT id_aliment FROM aliment WHERE nom LIKE '%s' LIMIT 1),(SELECT id_super_cat FROM super_categorie WHERE nom_super_cat LIKE '%s' LIMIT 1));",
               mysqli_real_escape_string($mysqli,$Aliment),mysqli_real_escape_string($mysqli,$super_cat));
               $Sql = $Sql.$requet;
            }
         }
		}

      //Nom du repertoire où se situe les photos
      $nom_repertoire = '../photos';
      //on ouvre le répertoire
      $pointeur = opendir($nom_repertoire);
      $tab_image = array();
      while ($fichier = readdir($pointeur)){
         $extension_file 	= strtolower( pathinfo($nom_repertoire.'/'.$fichier, PATHINFO_EXTENSION) );
         $extensions_array 	= array('gif','jpg','jpeg','png');
         if ( in_array($extension_file, $extensions_array) ){
            $tab_image[] = $fichier;
         }
      }
      //on ferme le répertoire
      closedir($pointeur);

      //On parcourt chaque recette
      foreach($Recettes as $id_recette => $liste_recettes){
         if(array_key_exists("titre", $liste_recettes)){
            //echo $liste_recettes["titre"]."<br>";
            $titre_recette = $liste_recettes["titre"];
         }
         if(array_key_exists("ingredients", $liste_recettes)){
            //echo $liste_recettes["ingredients"]."<br>";
            $ingredients_recette = $liste_recettes["ingredients"];
            $ingredients_recette = str_replace(";",",",$ingredients_recette);
         }
         if(array_key_exists("preparation", $liste_recettes)){
            //echo $liste_recettes["preparation"]."<br>";
            $preparation_recette = $liste_recettes["preparation"];
            $preparation_recette = str_replace(";",",",$preparation_recette);
         }
         
         
         
         $id_recette+=1;
         $nom_photo = "photos/coktail_default.jpg";
         foreach($tab_image as $nom_fichier){
            $str = sprintf("/^%s_.*$/",$id_recette);
            //echo $str."</br>";
            if(preg_match($str,$nom_fichier)){
               $nom_photo = "photos/".$nom_fichier;
            }
         }
         //echo $id_recette." -> ".$nom_photo."</br>";

         //On écrit la requête
         $requet = sprintf("INSERT INTO `recettes` (`nom`,`ingredients`,`preparation`,`photo`) VALUES('%s','%s','%s','%s');",
         mysqli_real_escape_string($mysqli,$titre_recette),
         mysqli_real_escape_string($mysqli,$ingredients_recette),
         mysqli_real_escape_string($mysqli,$preparation_recette),
         mysqli_real_escape_string($mysqli,$nom_photo));
         echo $requet."</br></br>";
         $Sql = $Sql.$requet;
         
         //On associe les aliments à la recette
         if(array_key_exists("index", $liste_recettes)){
            foreach($liste_recettes['index'] as $liste_aliments){
               //On écrit la requête pour associer l'aliment à la sous_cat
               $requet = sprintf("INSERT INTO `contient`(`id_recette`, `id_aliment`) VALUES ((SELECT id_recette FROM recettes WHERE nom LIKE '%s' LIMIT 1),(SELECT id_aliment FROM aliment WHERE nom LIKE '%s' LIMIT 1));",
               mysqli_real_escape_string($mysqli,$titre_recette),mysqli_real_escape_string($mysqli,$liste_aliments));
               //echo $requet."<br>";
               $Sql = $Sql.$requet;
            }
         }
      }
		
   //Ici je supprime le dernier ;
	$Sql = substr($Sql,0,-1);	
	foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

	mysqli_close($mysqli);	
?>