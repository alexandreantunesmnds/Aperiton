<?php // Creation de la base de donnees 

	function query($link,$requete)
	{ 
		$resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
		return($resultat);
	}
  
	$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
	$base="Boissons";
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
         );
		 
		INSERT INTO recette VALUES (0,'Alerte à Malibu','50 cl de malibu coco|50 cl de gloss cerise|1 l de jus de goyave blanche|1 poignée de griottes','Mélanger tous les ingrédients ensemble dans un grand pichet. Placer au frais au moins 3 heures avant de déguster. Tchin tchin !!');
		INSERT INTO recette VALUES (1,'Aperol Spritz','1 verre d\'aperol|3 verres de vin blanc pétillant type prosecco|5 glaçons|1 orange sanguine|2 verres d\'eau pétillante','Préparer la quantité de Boisson souhaitée en respectant les proportions ! Garnir de glaçons et d\'un morceau d\'orange (sanguine si possible). Santé !');
		INSERT INTO recette VALUES (2,'Aquarium','1/5 de curaçao|1/5 de rhum blanc|1/5 de tequila|1/5 de martini dry|1/5 de sirop de sucre de canne','Préparer le mélange dans un récipient transparent, ressemblant le plus possible à un aquarium, si vous n\'en avez pas! Mélanger. Ajouter des glaçons, et placer le tout au frigo. Décorer votre récipient, en y incorporant les éléments de déco. L\'effet aquarium doit être surprenant!Les proportions sont à adapter en fonction du nombre de personnes. Ce Boisson se boit normalement à la paille.');
		INSERT INTO recette VALUES (3,'Black velvet','12 cl de stout|12 cl de champagne','Verser le champagne dans un verre et ajouter la bière');
		INSERT INTO recette VALUES (4,'Bloody Mary','4 cl de vodka|12 cl de jus de tomates|0.5 cl de jus de citron|0.5 cl de sauce worcestershire|tabasco|sel de céleri|poivre','Mélanger les 4 premiers ingrédients directement dans un verre ou dans un verre à mélange avec des glaçons (pour refroidir sans trop diluer). Ajouter à convenance tabasco, sel de céleri et poivre.');
		INSERT INTO recette VALUES (5,'Bora bora','10 cl de jus d\'ananas|6 cl de jus de fruits de la passion|2 cl de sirop de grenadine|1 cl de jus de citrons|3 glaçons','Réaliser cette recette au shaker. Servir dans un verre contenant des glaçons avec une rondelle d\'orange.');
		INSERT INTO recette VALUES (6,'Builder','1 concombre|1 citron|1 cuillère à soupe de sucre|3 glaçons','Mixer le concombre dans la centrifugeuse, ajouter le jus du citron, le sucre et les glaçons. Servir dans un verre décoré d\'une tranche de citron.');
		INSERT INTO recette VALUES (7,'Caïpirinha','4 cl de cachaça|1/2 citron vert|1 cuillère à soupe de sucre en poudre|glaçons','Couper le citron vert en deux, puis en quartier en enlevant la partie blanche centrale, responsable de l\'amertume. Mettre le citron découpé et le sucre dans un verre et piler. Ajouter la glace et la cachaça. Mélanger à la cuillère.');
		INSERT INTO recette VALUES (8,'Champagne en Boisson','1 morceau de sucre roux|3 traits d\'angostura|1 cl de cognac|c 8 cl de champagne','Placer les ingrédients directement dans un verre de type flûte à champagne dans l\'ordre suivant : Imbiber le morceau de sucre d\'angostura, puis le mettre au fond d\'une flûte à champagne. Verser doucement le cognac (il doit recouvrir le morceau de sucre). Compléter avec du champagne bien frais.');
		INSERT INTO recette VALUES (9,'Citrouillette (Boisson au champagne)','noilly prat|champagne','Verser 1/3 de Nouilly Prat dans un verre puis 2/3 de Champagne bien frais. Déguster, c\'est excellent.');
		INSERT INTO recette VALUES (10,'Boisson Bacardi','24 cl de rhum bacardi|6 cl de sirop de grenadine|12 cl de jus de citron','1. Mettez le bacardi,le sirop de grenadine et le jus de citron dans un shaker.Secouez énergiquement. 2. Versez dans des verres et servez aussitôt.');
		INSERT INTO recette VALUES (11,'Boisson Bacardi, grenadine, citron','24 cl de rhum bacardi|6 cl de sirop de grenadine|12 cl de jus de citron','Mettez le sirop de grenadine,le jus de citron et le Bacardi dans un shaker. Secouez fortement. Versez dans des verres et servez tout de suite.');
		INSERT INTO recette VALUES (12,'Boisson Balalaïka','4 cl de vodka|2 cl de cointreau|4 cl de jus de citron|rondelles de citron|quelques glaçons','Verser les alcools et le jus de citron dans un verre haut, sur des glaçons. Décorer avec les rondelles de citron.');
		INSERT INTO recette VALUES (13,'Boisson Cava Vodka Lemon','10 cl de cava|2 cl de vodka|2 cl de sirop de citron vert|1 zeste de citron vert','Mélanger la vodka et le sirop de citron vert. Verser le cava dans une flûte. Ajouter délicatement le mélange vodka citron vert. Décorer avec le zeste de citron vert.');
		INSERT INTO recette VALUES (14,'Boisson Champagne et saké','75 cl de champagne|16 cl de saké|4 brins de coriandre fraîche','Dans une flûte à Champagne, verser 4 cl de saké et compléter avec le Champagne. Ajouter un brin de coriandre par verre. A votre santé.');
		INSERT INTO recette VALUES (15,'Boisson Eau de mer','6 bouteilles de mousseux|20 cl de curaçao|70 cl de triple sec|35 cl de sirop de citrons|35 cl de sirop d\'oranges|25 cl de sucre de canne','Dans un grand récipient mélanger le triple sec, le curacao, le pulco citron, le pulco orange et le sucre de canne. Ensuite, ajouter les bouteilles de mousseux bien fraîches. Servir aussitôt.');
		INSERT INTO recette VALUES (16, 'Boisson Fraisalia (sans alcool)','500 g de fraises|50 cl de jus d\'orange|10 cl de sirop de fraise|2 l de limonade|10 glaçons','Placer dans un saladier les fraises coupées en morceaux, le jus d\'orange et le sirop de fraise. Laisser reposer au frais au moins 2 heures. Au moment de servir, ajouter le limonade et les glaçons.');
		INSERT INTO recette VALUES (17, 'Boisson Grand Paradis','1 cl de cognac|c 5 cl de jus d\'abricot|10 cl environ de champagne','Mélanger au shaker le cognac et le jus d\'abricot. Verser dans un verre (type verre tulipe) et remplir de champagne.');
		INSERT INTO recette VALUES (18, 'Boisson Lion rouge','2 cl de whisky|2 cl de crème de cassis|2 traits de bénédictine|2 traits de pastis|glaçons','Remplir un shaker de glaçons, y verser les différents alcools. Fermer, puis agiter fortement quelques secondes. Servir.');
		INSERT INTO recette VALUES (19, 'Boisson MAP','1/3 de martini blanc|1 trait d\'angostura|2/3 de jus de pamplemousse','Mettre les flûtes au congélateur. Presser le pamplemousse ou ouvrir la bouteille ou le berlingot... Verser 1/3 martini, 2/3 jus de pamplemousse et 1 trait d\'angustura. Pour la déco : poser sur chaque verre une torsade de pain aux graines de pavot et sucre dorée au four mais pétrie d\'amour et à la MAP of course...');
		INSERT INTO recette VALUES (20, 'Boisson MTS','50 cl de martini|25 cl de triple sec|c 25 cl de sucre de canne|50 cl de jus de fruits multivitaminés','Dans un grand pichet, verser tous les ingrédients et les mélanger. Laisser reposer une heure au réfrigérateur. A déguster très frais.');
		INSERT INTO recette VALUES (21, 'Boisson Madras','40 cl jus d\'orange|20 cl de vin blanc|sirop de grenadine','Mélanger le jus d\'orange avec le vin blanc. Verser le mélange dans des verres. Ajouter un filet de sirop de grenadine.');
		INSERT INTO recette VALUES (22, 'Boisson Mexicain à ma façon','40 cl de tequila|1 l de jus de goyave|1 l de jus d\'ananas|30 cl de jus de pomme|1 sachet de sucre vanillé|3 ou 4 feuilles de menthe','Mélanger les jus de goyave et d\'ananas. Ajouter la téquila et le jus de pomme. Mélanger. Ajouter le sucre vanillé et secouer jusqu\'à ce que le sucre soit fondu. Ciseler les feuilles de menthe et les incorporer au Boisson. Réserver au frigo pendant 12 à 24 heures. Attention, l\'alcool de la téquila s\'évanouit vite. On ne le sent presque plus au bout de 48 heures, ne le préparer donc pas trop tôt. Filtrer le mélange et servir bien frais.');
		INSERT INTO recette VALUES (23, 'Boisson Pomabricotine','45 cl de jus d\'abricots|45 cl de jus de pommes|35 cl d\'eau gazeuse|2.5 cl de liqueur|5 cl de sirop de grenadine','Mélanger tous les ingrédients, mettre au frais et ajouter l\'eau gazeuse fraîche au dernier moment pour conserver le pétillant.');
		INSERT INTO recette VALUES (24, 'Boisson Pomenas','20 cl de jus de pamplemousse|20 cl de jus d\'ananas|20 cl de jus de pommes|quelques framboises|des glaçons','Verser les jus dans une cruche, ajouter les framboises pour donner la couleur et des glaçons pour la fraîcheur. Servir frais.');
		INSERT INTO recette VALUES (25, 'Boisson Whisky Cranberries','1 dose de whisky|2 doses de jus de cranberries','Simplement mélanger le tout et... Santé!')";

	foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

	mysqli_close($mysqli);	
?>