<?php

session_start();

require('classes/class_user.php');


if (isset($_POST['suscribe'])) {
    header ('Location: inscription.php');
}

if (!empty($_POST)){
    extract($_POST);
    
    if (isset($_POST['connexion'])) {
        $connect_user = new User ;
        $connect_user->connect("$login", "$password");

    }
}

if (isset($_SESSION['login'])) {
    $getinfos_user = new User;
    $getinfos_user->Getinfos();
}

?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Compte</title> 
        <link rel="stylesheet" type="text/css" href="compte.css">
    </head>

    <body>

      <?php require('header.php')?>

        <main>

            <?php if (!isset($_SESSION['login'])) { ?>

        
                <section class="container">

                    <div class="signin">

                        <div><h2 class="boxtitle">J'ai déjà un compte</h2></div>

                        <form action="compte.php" method="post">

                            <div><label for="login" class="userlabel">Login</label></div>
                            <div><input type="text" class="userinput" name="login"></div>

                            <div><label for="password" class="userlabel">Mot de passe</label></div>
                            <div><input type="password" class="userinput" name="password"></div>

                            <div><input type="submit" name="connexion" class="usersubmit" value="Se connecter"></div>

                        </form>
                    </div>

                    <div class="suscribe">

                        <h2 class="boxtitle">Je créé un compte</h2>

                        <div class="boxtext">Je peux réserver un séjour chez Happy Sardines.</div>
                        <div class="boxtext">Je peux consulter mes réservations.</div>
                        <div class="boxtext">Je peux consulter et modifier mes informations.</div>

                        <form action="inscription.php" method="post"><input type="submit" name="suscribe" class="usersubmit" value="Inscription"></form>


                    </div>

                    


                </div>
            <?php } ?>

            <!--  AFFICHAGE DU COMPTE SI CONNECTE  -->

            <?php if(isset($_SESSION['login'])) { ?> 
            
            <section class="connected">

                <div class="infosbox">

                    <div><h2 class="boxtitle"> Vos informations </h2></div>

                    <table border="1">
                        <tr>
                            <td>Login</td>
                            <td><?php echo $getinfos_user->login;?></td>
                        </tr>
                        <tr>
                            <td>Nom</td>
                            <td><?php echo $getinfos_user->nom;?></td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td><?php echo $getinfos_user->prenom;?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $getinfos_user->email;?></td>
                        </tr>
                    </table>

                    <form action="compte.php" method="post">
                        <input type="submit" name="changeinfos" value="Modifier">
                    </form>

                </div>

                <div class="reservationsbox">

                    <div><h2 class="boxtitle"> Vos réservations </h2></div>

                
                </div>
            </section>

            <?php } ?>


        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>