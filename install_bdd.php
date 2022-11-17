<?php // Creation de la base de donnees 

  function query($link,$requete)
  { 
    $resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
	return($resultat);
  }

  
$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
$base="Regions";
$Sql="
		DROP DATABASE IF EXISTS $base;
		CREATE DATABASE $base;
		USE $base;
		CREATE TABLE personne(
            id_personne VARCHAR(50),
            nom VARCHAR(50) NOT NULL,
            prenom VARCHAR(50) NOT NULL,
            adresse_mail VARCHAR(50),
            adresse_postale VARCHAR(50),
            num_tel VARCHAR(50),
            PRIMARY KEY(id_personne)
         );
         
         CREATE TABLE recette(
            id_recette INT,
            nom VARCHAR(50),
            ingredients VARCHAR(500),
            preparation VARCHAR(500),
            PRIMARY KEY(id_recette)
         );
         
         CREATE TABLE aliment(
            id_aliment INT,
            nom VARCHAR(50),
            PRIMARY KEY(id_aliment)
         );
         
         CREATE TABLE super_categorie(
            id_cat INT,
            nom_cat VARCHAR(50),
            PRIMARY KEY(id_cat)
         );
         
         CREATE TABLE sous_categorie(
            id_sous_cat INT,
            nom_sous_cat VARCHAR(50),
            PRIMARY KEY(id_sous_cat)
         );
         
         CREATE TABLE aime(
            id_personne VARCHAR(50),
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

foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

mysqli_close($mysqli);
?>