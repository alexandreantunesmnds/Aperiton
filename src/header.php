<?php
    if(isset($_GET['deconnexion'])){ 
        if($_GET['deconnexion']==true){ 
            session_unset();
            session_destroy();
            header('Location: aperiton.php');
        }
    }
?>
<header>
    <!-- Importation du fichier style css -->
    <!-- <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" /> -->
    <link rel="stylesheet" href="../css/header.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="path/to/font-awesome.css">

    <script type="text/javascript" src="../outils/completion.js"></script>

    <div id="top">
    <div id="top_left">
        <?php if(isset($_SESSION['username'])):?>
                <button onclick="window.location.href = 'profil.php';"><i class="fas fa-user" style='color:white;'></i>  <?php echo $_SESSION['username']?></button>
        <?php endif; ?>
    </div>

        <!-- Barre de recherche -->
        <div id="top_center">
        <div id="marque">
            <a href="aperiton.php"><h2>Aperiton</h2></a>
        </div>
            <form  autocomplete="off" method="GET" action="recherche.php">
            <div class="autocomplete" style="width:300px;">
                <!-- onRealeasKey="" -->
                <input id="myInput" type="search" placeholder="Rechercher une recette" name="search_recipe" >
                <button type="submit" class="search-button">
                <svg width="24" height="24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
                </button>
            </div>
            </form>
            </div>
            <script>
                var drinks = ["Alerte à Malibu",
                "Aperol Spritz : Boisson italien pétillant",
                "Aquarium",
                "Black velvet",
                "Bloody Mary",
                "Bora bora",
                "Builder",
                "Caïpirinha",
                "Champagne en Boisson",
                "Citrouillette (Boisson au champagne)",
                "Boisson Bacardi",
                "Boisson Bacardi, grenadine, citron",
                "Boisson Balalaïka",
                "Boisson Cava Vodka Lemon",
                "Boisson Champagne et saké",
                "Boisson Eau de mer",
                "Boisson Fraisalia (sans alcool)",
                "Boisson Grand Paradis",
                "Boisson Lion rouge",
                "Boisson MAP",
                "Boisson MTS",
                "Boisson Madras",
                "Boisson Mexicain à ma façon",
                "Boisson Pomabricotine",
                "Boisson Pomenas",
                "Boisson Whisky Cranberries",
                "Boisson anapomise",
                "Boisson apéritif",
                "Boisson apéritif aux framboises",
                "Boisson au Martini",
                "Boisson au cidre",
                "Boisson au kumquat et au litchi",
                "Boisson au limoncello",
                "Boisson aux agrumes sans alcool",
                "Boisson aux framboise",
                "Boisson bulles de melon",
                "Boisson café au lait",
                "Boisson cardinal",
                "Boisson champagne menthe citron vert",
                "Boisson champanisé",
                "Boisson citron-menthe (sans alcool)",
                "Boisson coco",
                "Boisson coco des amoureux",
                "Boisson crème de coco et banane",
                "Boisson de fruits",
                "Boisson de fruits au citron vert",
                "Boisson de jus de fruits pour les enfants",
                "Boisson de pomme ambrée",
                "Boisson des dimanches de neige",
                "Boisson des îles Praslin",
                "Boisson du verger",
                "Boisson exotique au fruit de la passion",
                "Boisson glacé tropical",
                "Boisson italien prosecco",
                "Boisson la variante (à base de rosé)",
                "Boisson light fraîcheur à la pastèque",
                "Boisson léger au martini",
                "Boisson mexicanos",
                "Boisson mousseux fraise citron vert (sans alcool)",
                "Boisson noix de coco-café",
                "Boisson pamplemousse menthe",
                "Boisson paradise",
                "Boisson pour les amoureux",
                "Boisson rose au whisky",
                "Boisson rose rosé pamplemousse",
                "Boisson rose sucré",
                "Boisson rouge",
                "Boisson sans alcool Cranberry-orange",
                "Boisson sans alcool KidiCana",
                "Boisson sans alcool Sweet Melon",
                "Boisson sans alcool Tropical Sunshine",
                "Boisson tropical délicieux",
                "Boisson white russian",
                "Coconut kiss",
                "Creole cream (Boisson)",
                "Cuba libre",
                "Frosty lime",
                "Gin fizz facile",
                "Ginger cosmo",
                "Grand Marnier sour (Boisson)",
                "Hulk ( Boisson )",
                "Le baiser de la Schtroumpfette",
                "Le vandetta",
                "Margarita",
                "Margarita à la fraise",
                "Mojito",
                "Mojito au Basilic",
                "Mojito cubain",
                "Negroni Boisson",
                "Pink 3x6 (Boisson sans alcool)",
                "Piña Colada",
                "Piña Colada (Boisson)",
                "Porto Flip",
                "Punch-sangria de pastèque",
                "Raifortissimo",
                "Rainbow",
                "Red Boisson",
                "Rhum arrangé à la pomme",
                "Rince-gouttes (Boisson)",
                "Sangria sans alcool",
                "Screwdriver",
                "Shoot up",
                "Shot piquant",
                "Soupe au Champagne (Boisson)",
                "Tequila sunrise",
                "Ti'punch",
                "Tutti Boisson",
                "Virevoltage"];
            const ingredients = [
                'Malibu',
                'coco',
                'Gloss cerise',
                'Jus de goyave blanche',
                'Griottes',
                'Aperol',
                'Vin blanc pétillant (type prosecco)',
                'Glaçons',
                'Orange sanguine',
                'Eau pétillante',
                'Curaçao',
                'Rhum blanc',
                'Tequila',
                'Martini dry',
                'Sirop de sucre de canne',
                'Stout',
                'Champagne',
                'Vodka',
                'Jus de tomates',
                'Jus de citron',
                'Sauce Worcestershire',
                'Tabasco',
                'Sel de céleri',
                'Poivre',
                'Jus d"ananas',
                'Jus de fruits de la passion',
                'Sirop de grenadine',
                'Jus de citrons',
                'Concombre',
                'Citron',
                'Sucre',
                'Glaçons',
                'Cachaça',
                'Citron vert',
                'Sucre en poudre',
                'Glaçons',
                'Sucre roux',
                'Angostura',
                'Cognac',
                'Champagne',
                'Noilly Prat',
                'Saké',
                'Coriandre fraîche',
                'Mousseux',
                'Curaçao',
                'Triple sec',
                'Sirop de citrons',
                'Sirop d"oranges',
                'Sucre de canne',
                'Fraises',
                'Jus d"orange',
                'Sirop de fraise',
                'Limonade',
                'Glaçons',
                'Jus d"abricot',
                'Whisky',
                'Crème de cassis',
                'Bénédictine',
                'Pastis',
                'Glaçons',
                'Martini blanc',
                'Angostura',
                'Jus de pamplemousse',
                'Martini',
                'Triple sec',
                'Sucre de canne',
                'Jus de fruits multivitaminés',
                'Jus d"orange',
                'Vin blanc',
                'Sirop de grenadine',
                'Tequila',
                'Jus de goyave',
                'Jus d"ananas',
                'Jus de pomme',
                'Sucre vanillé',
                'Feuilles de menthe',
                'Jus d"abricots',
                'Jus de pommes'];
                array = drinks.concat(ingredients);
                autocomplete(document.getElementById("myInput"), array);
            </script> 
        <!-- Bouton de connexion et de direction vers la page favoris -->
        <div id="top_right">
            <!-- Le cas où l'utilisateur est connu -->
            <?php if(isset($_SESSION['username'])): ?>
                    <button onclick="window.location.href = 'favoris.php';">
                        Mes favoris
                    </button>   
                    <button onclick="window.location.href = 'aperiton.php?deconnexion=true';">
                        Deconnexion
                    </button>
            <!-- Le cas où l'utilisateur est inconnu -->
            <?php else: ?>
                    <button onclick="window.location.href = 'connexion.php';">
                        Mes favoris
                    </button>   
                    <button onclick="window.location.href = 'connexion.php';">
                        Connexion
                    </button>
            <?php endif; ?>
        </div>
    </div>
    <!-- La barre de navigation horizontale -->
    <nav id="toolbar">
        <div><a href="recherche.php?search_recipe=tout">Toutes nos recettes</a></div>
        <div><a href="page2.html">Les recettes par catégories</a></div>
        <!-- On récupère une recette aléatoire -->
        <?php 
        /* Connexion à la base de données */
        $mysqli=mysqli_connect('localhost', 'root', '','Boissons') or die("Erreur de connexion");

        $requete = "SELECT count(*) FROM recettes";
        $exec_requete = mysqli_query($mysqli,$requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];

        /* On génère aléatoirement 3 nombre entre 1 et le nombre totale de recette */ 
        $random_id_recipe = rand(1,$count);

        $requete = "SELECT nom FROM recettes WHERE id_recette = $random_id_recipe";
        $exec_requete = mysqli_query($mysqli,$requete);
        $reponse = mysqli_fetch_array($exec_requete);
        ?>
        <div><a href="recette.php?nom=<?php echo $reponse['nom']; ?>">Recette au hasard</a></div>
        <div><a href="https://solidarites-sante.gouv.fr/prevention-en-sante/addictions/article/l-addiction-a-l-alcool">Mieux consommer</a></div>

    </nav>

</header>