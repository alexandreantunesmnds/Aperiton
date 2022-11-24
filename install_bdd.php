<?php // Creation de la base de donnees 
	//On réucpère les données depuis le fichier donnees.inc.php
	include_once("Donnees.inc.php");

	function query($link,$requete)
	{ 
		$resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
		return($resultat);
	}
  
   //On se connecte à la base de donnée
	$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
	$base="Boissons";
   //On crée la base de donnée
	$Sql="
		DROP DATABASE IF EXISTS $base;
		CREATE DATABASE $base;
		USE $base;
		CREATE TABLE personne(
            id_personne INT NOT NULL AUTO_INCREMENT,
            nom VARCHAR(50) NOT NULL,
            prenom VARCHAR(50) NOT NULL,
            adresse_mail VARCHAR(50),
            adresse_postale VARCHAR(50),
            num_tel VARCHAR(50),
            PRIMARY KEY(id_personne)
         );
         
         CREATE TABLE recette(
            id_recette INT NOT NULL AUTO_INCREMENT,
            nom VARCHAR(50),
            ingredients VARCHAR(500),
            preparation VARCHAR(500),
            PRIMARY KEY(id_recette)
         );
         
         CREATE TABLE aliment(
            id_aliment INT NOT NULL AUTO_INCREMENT,
            nom VARCHAR(50),
            PRIMARY KEY(id_aliment)
         );
         
         CREATE TABLE super_categorie(
            id_cat INT NOT NULL AUTO_INCREMENT,
            nom_cat VARCHAR(50),
            PRIMARY KEY(id_cat)
         );
         
         CREATE TABLE sous_categorie(
            id_sous_cat INT NOT NULL AUTO_INCREMENT,
            nom_sous_cat VARCHAR(50),
            PRIMARY KEY(id_sous_cat)
         );
         
         CREATE TABLE aime(
            id_personne INT,
            id_recette INT,
            PRIMARY KEY(id_personne, id_recette),
            FOREIGN KEY(id_personne) REFERENCES personne(id_personne),
            FOREIGN KEY(id_recette) REFERENCES recette(id_recette)
         );
         
         CREATE TABLE contient(
            id_recette INT,
            id_aliment INT,
            PRIMARY KEY(id_recette, id_aliment),
            FOREIGN KEY(id_recette) REFERENCES recette(id_recette),
            FOREIGN KEY(id_aliment) REFERENCES aliment(id_aliment)
         );
         
         CREATE TABLE cat_par(
            id_aliment INT,
            id_cat INT,
            PRIMARY KEY(id_aliment, id_cat),
            FOREIGN KEY(id_aliment) REFERENCES aliment(id_aliment),
            FOREIGN KEY(id_cat) REFERENCES super_categorie(id_cat)
         );
         
         CREATE TABLE sous_cat_par(
            id_aliment INT,
            id_sous_cat INT,
            PRIMARY KEY(id_aliment, id_sous_cat),
            FOREIGN KEY(id_aliment) REFERENCES aliment(id_aliment),
            FOREIGN KEY(id_sous_cat) REFERENCES sous_categorie(id_sous_cat)
         );";

      //On remplit la base de donnée
		$aliment_deja_vu = Array();

		//On parcours chaque données du tableau Hierarchie
		foreach($Hierarchie as $Aliment => $Categories){
         //On parcout chaque aliment
         array_push($aliment_deja_vu, $Aliment);
        
         //On parcourt chaque sous-cat
         //todo : vérifier si ça existe
         if(array_key_exists("sous-categorie", $Categories)){
            foreach($Categories['sous-categorie'] as $sous_cat){
               //$nom_sous_cat = str_replace("'","\'",$sous_cat);
               //echo $nom_sous_cat."<br>";
               $requet = sprintf("INSERT INTO `sous_categorie` (`nom_sous_cat`) VALUES('%s'",mysqli_real_escape_string($mysqli,$sous_cat));
               $requet = $requet.");";
               echo $requet."<br>";
               $Sql = $Sql.$requet;
            }
         }
      

         //todo : vérifier si ça existe
         /*foreach($Categories['super-categorie'] as $super_cat){
            
         }*/

         //todo : insérer aliment

		}
		
   //Ici je supprime le dernier ;
	$Sql = substr($Sql,0,-1);	
	foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

	mysqli_close($mysqli);	
?>