<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Accueil</title> 
        <link rel="stylesheet" href="view/style/header.css">
        <link rel="stylesheet" href="view/style/index.css">
    </head>

    <body>

        <header>
            <div class="nav-wrapper">
                <div class="logo-container">
                    <img class="logo" src="view/assets/logo.png" alt="Logo">
                </div>
                <nav>
                    <input class="hidden" type="checkbox" id="menuToggle">
                        <label class="menu-btn" for="menuToggle">
                            <div class="menu"></div>
                            <div class="menu"></div>
                            <div class="menu"></div>
                        </label>

                    <div class="nav-container">
                        <ul class="nav-tabs">
                            <li class="nav-tab"><a href="index.php">Accueil</a></li>
                            <li class="nav-tab"><a href="view/compte.php">Mon Compte</a></li>
                            <li class="nav-tab"><a href="view/lecamping.php">Le Camping</a></li>
                            <li class="nav-tab"><a href="view/reservations.php">Réserver</a></li>
                            <li class="nav-tab"><a href="view/tarifs.php">Tarifs</a></li>
                            <?php if (isset($_SESSION['admin']) == '1') { ?><li class="nav-tab"><a href="planning.php">Planning</a></li><?php } ?>
                            <?php if (isset($_SESSION['admin']) == '1') { ?><li class="nav-tab"><a href="planning.php">Gestion tarifs</a></li><?php } ?>
                            <?php if(isset($_SESSION['login'])){?><li class="nav-tab"><a href="../model/deconnexion.php">Déconnexion</a><?php }?></li> 
                        </ul>
                    </div>
                  
                </nav>
            </div>
        </header>

        <main>

            <section class="container">

                <h1>Camping <br>

                    Happy Sardines
                </h1>
                
                <p>

                    Installez vous chez Happy Sardines</br>
                    
                    et découvrez le coeur de la FRENCH RIVIERA.</br>

                    Découvrez le site <a href="view/lecamping.php">ici</a>.

                </p>
            </section>


        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>