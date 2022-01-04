<?php
    session_start();

    require('./bdd.php');
    require('classes/class_user.php');

    if (!empty($_POST)) {
        extract($_POST);
        if (isset($_POST['inscription'])) {

            $create_user = new User();
            $create_user->register("$login", "$email", "$prenom", "$nom", "$confemail", "$password", "$confpassword");
            
        }
    }
?>



<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Inscription</title> 
    </head>

    <body>

        <?php require('header.php') ?>

        <main>

            <?php if(isset($err_login)) { echo $err_login;} ?>

            <form action="inscription.php" method="post">
                
                
                <div><input type="text" name="login" placeholder="login" value="<?php if(isset($login)){echo $login;} ?>"></div>
                <div><?php if(isset($err_prenom)){echo $err_prenom;}?></div>
                <div><input type="text" name="prenom" placeholder="prenom" value="<?php if(isset($prenom)){echo $prenom;} ?>"></div>
                <div><?php if(isset($err_nom)){echo $err_nom;}?></div>
                <div><input type="text" name="nom" placeholder="nom" value="<?php if(isset($nom)){echo $nom;} ?>"></div>
                <div><?php if(isset($err_email)){echo $err_email;}?></div>
                <div><input type="text" name="email" placeholder="email"value="<?php if(isset($email)){echo $email;} ?>"></div>
                <div><?php if(isset($err_confemail)){echo $err_confemail;}?></div>
                <div><input type="text" name="confemail" placeholder="Confirmer l'email" value="<?php if(isset($confemail)){echo $confemail;} ?>"></div>
                <div><?php if(isset($err_password)){echo $err_password;}?></div>
                <div><input type="password" name="password" placeholder="Mot de passe"></div>
                <div><?php if(isset($err_confpassword)){echo $err_confpassword;}?></div>
                <div><input type="password" name="confpassword" placeholder="Confirmer le mot de passe"></div>
                <div><input type="submit" name="inscription" value="Inscription"></div>
            </form>
        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>