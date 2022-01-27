<?php

    require('../model/bdd.php');


    if (isset($_POST['update_site_rate'])) {

        $table = "equipments";
        $rate1 = (int) ($_POST['day_site_rate']);
        $rate2 = (int) ($_POST['day_site_rate']) * 2 ;
        $set = "SET CASE
        WHEN id = 1 THEN rate=:rate1
        WHEN id = 2 THEN rate=:rate2
        END
        WHERE id IN (1,2)";
        $password = htmlspecialchars($_POST['password']);
        $login = $_SESSION['login'];
        

        $data_pass = [
            'login' => $login,
            'password'=> md5($password),
        ] ;

        $sql = "SELECT * FROM users WHERE login=:login && password=:password";
        $check_password = $bdd->prepare($sql);
        $check_password->setFetchMode(PDO::FETCH_ASSOC);
        $check_password->execute($data_pass);

        $checking = $check_password->fetchAll();
    
        if($checking) {

            $update_site_rate = new Rates ;
            $update_site_rate->UpdateRate($set, $table, $rate1, $rate2);
        }

        else $err_password = "Le mot de passe est incorrect.";



    }


?>