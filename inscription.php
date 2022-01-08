<?php
    session_start();

    require('./bdd.php');
    require('classes/class_user.php');

    if (!empty($_POST)) {
        extract($_POST);
        if (isset($_POST['inscription'])) {

            $create_user = new User();
            $create_user->register("$login", "$email", "$firstname", "$lastname", "$checkemail", "$password", "$checkpassword");
            
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
                <div><?php if(isset($err_firstname)){echo $err_firstname;}?></div>
                <div><input type="text" name="firstname" placeholder="prenom" value="<?php if(isset($firstname)){echo $firstname;} ?>"></div>
                <div><?php if(isset($err_lastname)){echo $err_lastname;}?></div>
                <div><input type="text" name="lastname" placeholder="nom" value="<?php if(isset($lastname)){echo $lastname;} ?>"></div>
                <div><?php if(isset($err_email)){echo $err_email;}?></div>
                <div><input type="text" name="email" placeholder="email"value="<?php if(isset($email)){echo $email;} ?>"></div>
                <div><?php if(isset($err_checkemail)){echo $err_checkemail;}?></div>
                <div><input type="text" name="checkemail" placeholder="Confirmer l'email" value="<?php if(isset($checkemail)){echo $checkemail;} ?>"></div>
                <div><?php if(isset($err_password)){echo $err_password;}?></div>
                <div><input type="password" name="password" placeholder="Mot de passe"></div>
                <div><?php if(isset($err_checkpassword)){echo $err_checkpassword;}?></div>
                <div><input type="password" name="checkpassword" placeholder="Confirmer le mot de passe"></div>
                <div><input type="submit" name="inscription" value="Inscription"></div>
            </form>
        </main>

     <!-- REQUIRE LE FOOTER -->
    
    </body>
</html>