<?php


?>

<head>
    <link rel="stylesheet" type="text/css" href="header.css">
</head>
  
<header>
        <div class="nav-wrapper">
            <div class="logo-container">
                <img class="logo" src="assets/logo" alt="Logo">
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
                        <li class="nav-tab"><a href="compte.php">Mon Compte</a></li>
                        <li class="nav-tab"><a href="camping.php">Camping</a></li>
                        <li class="nav-tab"><a href="reservations.php">Réservations</a></li>
                        <li class="nav-tab"><a href="tarif.php">Tarifs</a></li>
                        <li class="nav-tab"><a href="contacts.php">Contacts</a></li>
                        <li class="nav-tab"><?php if(isset($_SESSION['login'])){?><a href="deconnexion.php">Déconnexion</a><?php }?></li> 
                    </ul>
                </div>
            </nav>
        </div>
    </header>