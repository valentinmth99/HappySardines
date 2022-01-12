<?php


?>

<head>
    <link rel="stylesheet" type="text/css" href="style/header.css">
</head>
  
<header>
        <div class="nav-wrapper">
            <div class="logo-container">
                <img class="logo" src="assets/logo.png" alt="Logo">
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
                        <li class="nav-tab"><a href="view/camping.php">Le Camping</a></li>
                        <li class="nav-tab"><a href="view/reservations.php">Réservations</a></li>
                        <li class="nav-tab"><a href="view/tarif.php">Tarifs</a></li>
                        <li class="nav-tab"><a href="view/contacts.php">Contacts</a></li>
                        <li class="nav-tab"><?php if(isset($_SESSION['login'])){?><a href="../model/deconnexion.php">Déconnexion</a><?php }?></li> 
                    </ul>
                </div>
            </nav>
        </div>
    </header>