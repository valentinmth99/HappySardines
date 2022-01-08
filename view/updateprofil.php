<?php

session_start();

require('classes/class_user.php');

echo $_SESSION['login'];

// récupération des infos pour préremplissage du formulaire

$getinfos_user = new User;
$getinfos_user->Getinfos();

?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Compte</title> 
    </head>

    <body>

        <?php require('header.php') ?>

        <main>
            
            <section class="centralbox">

                <div><h2 class="boxtitle">Modifier vos informations</h2></div>
                <div><?php if (isset($message)) { echo $message;}?></div>

                <div class="form">

                    <form action="update-infos.php" method="post">

                        <div><input type="text" name="newlogin" placeholder="login" value="<?php if (isset($newlogin)) { echo $newlogin ;} else echo $getinfos_user->login ;?>"></div>
                        <div><input type="text" name="newfirstname" placeholder="firstname" value="<?php if (isset($newfirstname)) { echo $newfirstname ;} else echo $getinfos_user->firstname ; ?>"></div>
                        <div><input type="text" name="newlastname" placeholder="lastname" value="<?php if (isset($newlastname)) { echo $newlastname ;} else echo $getinfos_user->lastname ?>"></div>
                        <div><input type="text" name="newemail" placeholder="email"value="<?php if (isset($newmail)) { echo $newmail; } else echo $getinfos_user->email ?>"></div>
                        <div><input type="text" name="checkemail" placeholder="Confirmer l'email" value="<?php if(isset($confemail)){echo $confemail;} ?>"></div>
                        <div><input type="password" name="password" placeholder="Confirmez avec votre mot de passe."></div>
                        <div><input type="submit" name="updateinfos" value="Changer les informations"></div>


                    </form>
                
                </div>

                <div><h2 class="boxtitle">Modifier votre mot de passe</h2></div>

                <div class="form">

                    <form action="change-infos.php" method="post">

                        <div><input type="password" name="actualpassword" placeholder="Mot de passe actuel"></div>
                        <div><input type="password" name="newpassword" placeholder="Nouveau mot de passe"></div>
                        <div><input type="password" name="checkpassword" placeholder="Confirmer le mot de passe"></div>
                        <div><input type="submit" name="updatepassword" value="Changer le mot de passe"></div>

                    </form>
                </div>

            </section>

        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>
