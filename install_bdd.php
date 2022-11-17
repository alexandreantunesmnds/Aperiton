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
		INSERT INTO recette VALUES (25, 'Boisson Whisky Cranberries','1 dose de whisky|2 doses de jus de cranberries','Simplement mélanger le tout et... Santé!');
		INSERT INTO recette VALUES (26, 'Boisson anapomise','25 cl de jus de cerises|25 cl de jus de pommes|25 cl de jus d\'ananas|2,5 cl d\'alcool de prune|2,5 cl de sirop de sucre de canne','Mélangez tous les ingrédients et servir bien frais.');
		INSERT INTO recette VALUES (27, 'Boisson apéritif','2 l de vin blanc sec|200 g sucre|2 citrons|2 oranges|2 grands verres de rhum|1 grande bouteille de perrier','Mélanger tous les ingrédients et servir très frais.');
		INSERT INTO recette VALUES (28, 'Boisson apéritif aux framboises','1 l de vin blanc|2 l de mousseux|250 g de framboises surgelées|4 à 5 cuillères à soupe de sucre','Mélanger le vin blanc, les mousseux et le sucre. Ajouter les framboises surgelées... Déguster bien frais...');
		INSERT INTO recette VALUES (29, 'Boisson au Martini','1 l de martini blanc|1.5 l de schweppes aux agrumes|1 citron','Mélanger les liquides. Couper le citron en gros morceaux et l\'ajouter. Servir très frais avec des glaçons.');
		INSERT INTO recette VALUES (30, 'Boisson au cidre','1 bouteille de cidre brut|1/2 verre de crème de cassis|1/2 verre de cointreau','Mélanger le cassis et le cointreau. Tenir au frais tous les ingrédients. Et au dernier moment ajouter le cidre.');
		INSERT INTO recette VALUES (31, 'Boisson au kumquat et au litchi','5 kumquats|5 litchis|1 clémentine|1/2 orange|1/2 l d\'eau|1 l de limonade','Mixer au mixeur tous les fruits ainsi que l\'eau jusqu\'à obtenir un mélange homogène. Ajouter le litre de limonade. Mettre au réfrigérateur 1 h.');
		INSERT INTO recette VALUES (32, 'Boisson au limoncello','2 oranges|5 cl de rhum ambré|1 trait de limoncello|glaçons','Verser le rhum ambré dans le verre. Presser les 2 oranges, puis ajouter le jus au rhum. Ajouter ensuite le trait de Limoncello, remuer et ajouter quelques glaçons. C\'est prêt !');
		INSERT INTO recette VALUES (33, 'Boisson aux agrumes sans alcool','6 cl jus d\'orange|4.5 cl jus de citron jaune|2 cuillères à café de sirop de grenadine ou de fraise','Mesurer chacun des ingrédients et les verser dans un shaker. Bien secouer. Verser le tout dans un verre à Boisson ou une flûte à champagne. Réitérer l\'opération pour chaque personne.');
		INSERT INTO recette VALUES (34, 'Boisson aux framboise','450 g de framboise surgelés|1 bouteille de sirop de sucre de canne|50 cl de kirsch|1 l de limonade|1 citron|3 bouteilles de crémant d’alsace','La veille : mettre les framboises, le citron en tranches, 3 verres de sirop de sucre de canne, le kirsch et la moitié de la limonade dans un gros recipient, puis laisser macérer au frigo. Mettre le reste de limonade et les bouteilles de crémant au frigo. Juste avant de servir : Rajouter à la préparation de la veille le reste de limonade et les bouteilles de Crémant. Goûter et rajouter du sucre de canne si besoin car certain crémants son plus amers que d’autre.');
		INSERT INTO recette VALUES (35, 'Boisson bulles de melon','2 melons|1 bouteille de crémant ou de champagne|sirop de sucre de canne|1 citron|glaçons','Otez les pépins des melons et mixez le melon. Pressez le citron. Mélangez le tout avec le vin pétillant, puis rajoutez des glacons et sucrez à votre goût. Servez de suite.');
		INSERT INTO recette VALUES (36, 'Boisson café au lait','4 à 6 cl de liqueur de café|4 à 6 cl de whisky|30 cl de lait|2 à 6 cl de sucre de canne|4 glaçons','Dans un shaker, verser tous les ingrédients + 2 glaçons. (répartir les autres glaçons dans le verre). Agiter le shaker jusqu\'à ce que les glaçons soient quasimment fondus. Verser dans un verre large voire évasé afin d\'obtenir une mousse onctueuse.');
		INSERT INTO recette VALUES (37, 'Boisson cardinal','glace pilée|3 cl de campari|3 cl de noilly prat original dry|3 cl de gin','Dans un shaker, remplir de glace à moitié.Verser les ingrédients. Frapper. Servir dans un verre à Boisson et ajouter un zeste de citron.');
		INSERT INTO recette VALUES (38, 'Boisson champagne menthe citron vert','1 bouteille de champagne|glaçons|1 cuillère à café de jus de citron vert|2 feuilles de menthe|1 zeste de citron','Mettre dans un verre des glaçons à volonté. Ajouter une feuille découpée en deux et une entière pour la déco. Joindre le jus de citron vert et submerger de Champagne. Laisser reposer 2 min le temps que la saveur monte. Puis savourer !');
		INSERT INTO recette VALUES (39, 'Boisson champanisé','4 bouteilles de mousseux|1/2 bouteille cointreau|10 citrons pressés avec pulpe|2 verres de sirop de sucre de canne|des glaçons','Dans un grand récipient, verser le Cointreau, le jus des citrons avec leur pulpe et le sirop de sucre de canne. Verser le mousseux en dernier. Ajouter des glaçons. Servez dans des verres frais (l\'idéal est de les placer au réfrigérateur avant).');
		INSERT INTO recette VALUES (40, 'Boisson citron-menthe (sans alcool)','4 cl de sirop de menthe|1 trait de sirop de sucre de canne|2 cl de jus de citron vert|3 cl de jus de citron jaune|1 branche de menthe fraîche|1 tranche de citron','Mettre dans un shaker, avec de la glace, le sirop de menthe, le sirop de sucre et les jus de citron. Bien agiter. Verser dans un verre, décorer d\'une branche de menthe et d\'une tranche de citron.');
		INSERT INTO recette VALUES (41, 'Boisson coco','30 cl de vodka|1/2 l de lait|2 boules de glace à la noix de coco|2 boules de vanille|sirop de coco ou sirop de sucre de canne|5 glaçons','Mettre le tout dans un mixeur et dégustez.');
		INSERT INTO recette VALUES (42, 'Boisson coco des amoureux','1 noix de coco|rhum blanc','Percer la noix de coco en 3 endroits sur le dessus, et vider l\'eau à l\'intérieur. Remplir entièrement de rhum blanc. Boucher les trous en retaillant un bouchon de liège, et fermer hermétiquement en faisant couler de la cire de bougie dessus.Ranger debout, au frigo, pendant 3 semaines.');
		INSERT INTO recette VALUES (43, 'Boisson crème de coco et banane','crème de coco|jus de banane|sirop de fraise|citron vert','Dans le fond d\'un verre verser 3 cuillères à café de crème de coco. Diluer avec du jus de banane jusqu\'a ce que le liquide ait un aspect uniforme. Ajouter un peu de sirop de cassis et quelques gouttes de jus de citron vert. Servir très frais.');
		INSERT INTO recette VALUES (44, 'Boisson de fruits','1 banane|1 pomme|2 kiwis|1 petit bol d\'eau|1 sachet de sucre vanillé|3 cuillères à soupe de cassonade','Peler et couper les fruits en morceaux. Les mettre dans le blender (ou tout autre récipient à Boisson), puis mixer le tout, en rajoutant peu à peu l\'eau, jusqu\'à obtention de la consistance voulue (moi j\'aime bien quand c\'est un peu épais). Rajouter ensuite le sucre vanillé et la cassonade, selon le goût. Mixer une dernière fois pour que le sucre s\'intègre bien au mélange. Mettre au frais pendant une petite heure et déguster !');
		INSERT INTO recette VALUES (45, 'Boisson de fruits au citron vert','10 cl de de lait de coco|20 cl de jus multivitaminé|1 cuillère à café de jus de citron vert|quelques glaçons|1 rondelle de citron vert','Versez 10 cl de lait de coco et 20 cl de jus multivitaminé dans un shaker. Ajoutez une cuillère à café de jus de citron vert et quelques glaçons. Mélangez bien et servez dans un verre à cockail. décorez avec une rondelle de citron vert.');
		INSERT INTO recette VALUES (46, 'Boisson de jus de fruits pour les enfants','5 cuillères à soupe de jus d\'ananas|3 cuillère à soupe de jus de pommes|2 glaçons|1 rondelle d\'ananas|1 rondelle de pomme|1 cuillère à café de sucre en poudre','Mettre le jus de pomme et le jus d\'ananas dans un grand verre, puis mélanger. Ajouter le sucre et remuer à nouveau, puis ajouter les glaçons. Mettre 5 min au frigo. Au moment de servir, mettre les rondelles d\'ananas et de pommes sur le bord du verre pour la déco.');
		INSERT INTO recette VALUES (47, 'Boisson de pomme ambrée','1 pomme|1 citron|6 glaçons|10 cl de jus de pomme|5 cl de calvados|10 cl de crème de cassis|champagne|un peu de cassis|morceaux de pommes|morceaux d\'ananas','Taillez une pomme en fines tranches et arrosez-les avec le jus d\'un citron. Réservez. Mettez 6 glaçons dans votre shaker, versez 10 cl de jus de pomme, 5 cl de calvados et 10 cl de crème de cassis. Agitez pendant 10 secondes. Répartissez dans 4 verres à Boisson, puis remplissez de champagne. Décorez de cassis, pomme et ananas.');
		INSERT INTO recette VALUES (48, 'Boisson des dimanches de neige','une poignée de framboises|2 cuillères à café de sirop de gratte-cul|1/2 pamplemousse|1 orange','Mettre au fond d\'un joli verre, les framboises et le sirop. Ajouter le jus d\'orange et de pamplemousse pressés. Servir bien frais et regarder la neige par la fenêtre en se demandant si, vraiment, on va sortir aujourd\'hui.');
		INSERT INTO recette VALUES (49, 'Boisson des îles Praslin','40 cl de jus de mangue|30 cl de jus d\'ananas|20 cl de jus de fruit de la passion|10 cl de jus de citron vert|1 cuillère à soupe de sucre','On mélange le tout dans une bouteille. On secoue bien pendant 20 secondes environ et on met au frigo pour que ça soit bien frais au moment de servir. A servir dans des grands verres à Boisson et avec des jolies pailles colorées.');
		INSERT INTO recette VALUES (50, 'Boisson du verger','4 cl de liqueur d\'abricot|5 cl de liqueur de pomme|12 cl de jus de poire|3 glaçons','Dans un grand verre à Boisson, installer les 3 glacons. Verser chaque ingrédient dans l\'ordre énoncé ci-dessus. Bien mélanger et déguster !!');
		INSERT INTO recette VALUES (51, 'Boisson exotique au fruit de la passion','1 l de limonade|35 cl de sirop de curaçao|35 cl de sirop de fruit de la passion|20 cl de jus de citron|5 glaçons','Dans un shaker, mélanger le sirop de curaçao, le sirop de fruit de la passion et le jus de citron. Bien secouer puis verser le mélange obtenu dans un récipient. Incorporer le litre de limonade et bien mélanger. Ajouter les 5 glaçons et servir.');
		INSERT INTO recette VALUES (52, 'Boisson glacé tropical','10 cl du jus de citron vert|10 cl de jus de mangue|1/2 banane|100 g de glace à la mangue|coulis de framboise','Mixez tous les ingrédients (sauf le coulis) jusqu\'à ce que le mélange soit bien onctueux. Décorez votre verre d\'un peu de coulis, et versez votre préparation dans ce même verre.');
		INSERT INTO recette VALUES (53, 'Boisson italien prosecco','75 cl de prosecco|20 litchis|30 cl de jus de litchis|10 cl de jus de baies|1 l à 1,5 l de limonade au pamplemousse pétillante, impérativement','Mélanger les ingrédients juste avant de servir. Verser dans des verres hauts. Éventuellement, préparer une petite brochette avec un litchi et une cerise par personne.');
		INSERT INTO recette VALUES (54, 'Boisson la variante (à base de rosé)','5,33l de vin rosé|0,66l de sirop d\'agrumes|4l de jus d\'orange','mélangez le tout Boire très frais, à consommer avec modération');
		INSERT INTO recette VALUES (55, 'Boisson light fraîcheur à la pastèque','300 g de pastèque|1 yaourt 0%|2 cuillères de sirop de roses','Enlevez les pépins de la pastèque. Dans un mixeur, mettez la pastèque coupée en morceaux, le yaourt et le sirop de rose. Mixez le tout ! Servez aussitôt !!!');
		INSERT INTO recette VALUES (56, 'Boisson léger au martini','1 bouteille de martini rosé|1 bouteille d\'eau minérale gazeuse|2 citrons verts|une poignée de feuilles de menthe fraîche|2 cuillères à soupe de sucre','Verser le martini dans un grand pichet, ajouter le sucre et faire fondre.Ajouter ensuite les citrons coupés en morceaux et la menthe. Mélanger et mettre au frais au moins 4 heures (une nuit c\'est mieux). Au moment de servir, verser la bouteille d\'eau gazeuse.');
		INSERT INTO recette VALUES (57, 'Boisson mexicanos','12 cl de bière desperados|12 cl de jus d\'ananas|1 trait de sirop de fraises','Dans un verre à bière, verser un trait de sirop de fraise. Compléter avec la bière, en penchant le verre pour éviter de faire trop de mousse, et verser ensuite le jus d\'ananas. Boire très frais.');
		INSERT INTO recette VALUES (58, 'Boisson mousseux fraise citron vert (sans alcool)','400 g de fraises|2 c.à s.de sucre|10 cl de jus de citron vert|30 cl de limonade','Laver, équeuter les fraises.Les mettre dans un mixer.Ajouter le jus des citrons verts et le sucre.Mixer.Verser la limonade et mixer de nouveau.Réserver au frais jusqu\'au moment de servir. Voilà c\'est terminé !!! Bonne dégustation !!');
		INSERT INTO recette VALUES (59, 'Boisson noix de coco-café','2,5 cl malibu coco|2,5 cl lait de coco|2 cl de lait de soja|1 demi tasse à c. de café bien serré|1 cl de sirop de sucre de canne|5 glaçons pillés','Mettre les ingrédients dans un shaker. Agiter énergiquement en maintenant fermement et à deux mains le shaker et ses bouchons. Verser dans de jolis verres à Boisson.Décorer cette préparation de poudre de noisette.');
		INSERT INTO recette VALUES (60,'Boisson pamplemousse menthe','1 pamplemousse|2 cuillères à soupe de glace pilée|2 cuillères à soupe de sucre roux|10 feuilles de menthe','Retirer le jus des pamplemousses, verser ce jus dans le blender, ajouter le reste des ingrédients et mixer le tout!!');
		INSERT INTO recette VALUES (61, 'Boisson paradise','10 cl de jus d\'orange|4 cl de vodka|2 cl de pisang ambon|2 cl de sucre de canne','Réunir les ingrédients, hormis le Pisang, dans un shaker. Frapper. Verser dans un verre à Boisson, puis ajouter le Pisang. Servir frais.');
		INSERT INTO recette VALUES (62, 'Boisson pour les amoureux','12 cl de jus d\'oranges|18 cl de cointreau|10 cl de cognac|3 traits de grenadine|10 cl de champagne|quelques framboises','Mélanger tous les ingrédients (si possible préalablement mis au frigo) à la cuillère ou au shaker. Ajouter uniquement avant de servir les framboises (pour qu\'elles gardent leur consistance) ou une heure avant si vous les souhaitées bien imbibées.');
		INSERT INTO recette VALUES (63, 'Boisson rose au whisky','400 g de framboises|6 brins de coriandre fraîche|5 cl de whisky|15 cl de crème fraîche|3 cuillères à soupe de pistaches non salées concassées','1. Mixez les framboises avec la crème et 15 cl d\'eau glacée.Répartissez le mélange obtenu dans des verres. 2. Ajoutez un trait de whisky et parsemez de pistaches concassées.Décorez d\'une tige de coriandre et réservez au frais jusqu\'au moment de servir.');
		INSERT INTO recette VALUES (64, 'Boisson rose rosé pamplemousse','1 bouteille de vin rosé|30 cl de jus de pamplemousse rose|5 cl de grenadine','Dans une grande carafe, versez le sirop de grenadine puis le vin rosé et le jus de pamplemousse. Servir très frais.');
		INSERT INTO recette VALUES (65, 'Boisson rose sucré','150 g de framboises|1 citron|8 glaçons|10 cl de jus de raisin|15 cl de jus d\'orange|schweppes|fruits des bois, baie','Versez dans le bol d\'un mixeur les framboises et le jus du citron. Mixez pour obtenir un fin coulis. Refroidissez un shaker avec 6 glaçons. Jetez l\'eau puis remettez 2 glaçons, le coulis de framboise filtré, le jus de raisin et le jus d\'orange. Ajoutez 10 secondes puis versez dans 4 verres hauts. Complétez avec le schweppes. Décorez de fruits des bois.');
		INSERT INTO recette VALUES (66, 'Boisson rouge','liqueur de litchi|liqueur de fraise|jus d\'orange','Mélanger dans un verre les proportions suivantes: 40% de liqueur de litchi 20% de liqueur de fraise 40% de jus d\'orange. Et vive l\'apéro!');
		INSERT INTO recette VALUES (67, 'Boisson sans alcool Cranberry-orange','25 cl de jus de cranberry|10 cl de jus d\'orange|150 g de framboises|2 rondelles de citron ou d\'orange|1 cuillère à soupe de jus de citron','Mélanger les deux jus. Ajouter les framboises et le jus de citron. Mixer le tout en purée. Servir frappé ou avec quelques glaçons. Décorer vos verres d\'une rondelle de citron ou d\'orange. A votre santé !');
		INSERT INTO recette VALUES (68, 'Boisson sans alcool KidiCana','5 cl de jus de pomme pétillant kidibul|gingembre|1 cl de sirop de cassis|1 brin de citronnelle|1 pointe de couteau de gingembre en poudre|5 à 6 cuillères à soupe de glace pilée','Ciseler la citronnelle. Mettre tous les ingrédients dans un shaker. Ajouter la moitié de la glace pilée. Secouer et verser dans un verre garni du reste de la glace pilée. A votre santé !');
		INSERT INTO recette VALUES (69, 'Boisson sans alcool Sweet Melon','1 melon vert ovale|2 citrons verts|1 litre de jus d\'oranges|1 litre de jus d\'ananas|1/2 litre d\'eau pétillante','Couper la chair du melon en dès. Presser les citrons verts. Verser tous les jus de fruits dans un saladier. Ajouter les dès de melon et laisser reposer au frais pendant 2 heures. Ajouter l\'eau pétillante juste avant de servir.');
		INSERT INTO recette VALUES (70, 'Boisson sans alcool Tropical Sunshine','10 cl de jus d\'ananas|5 cl de jus d\'oranges|2 cl de sirop de cassis|1 cuillère à café de noix de coco râpée|glaçons','Verser les jus de fruits bien frais et le sirop de cassis dans un verre large. Ajouter quelques glaçons et parsemer de noix de coco râpée.')";
	
		
	foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

	mysqli_close($mysqli);	
?>