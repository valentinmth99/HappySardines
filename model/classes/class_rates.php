<?php


class Rates {


    // DECLARATION DES METHODES 

    public function __construct() { 
        $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');
            echo "Connecté à la bdd";
            $this->connexion=$bdd;
            
        }

        catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function DisplaySiteRate() {

        $query = "SELECT rate FROM equipments WHERE id = :id ";
        $get_rate = $this->connexion->prepare($query);
        $get_rate->setFetchMode(PDO::FETCH_ASSOC);
        $get_rate->execute(['id'=>1]);

        $get_site_rate =  $get_rate->fetch();

        $site_rate = (int)$get_site_rate['rate'];

       return $site_rate;
    }

    public function DisplayOptionsRate() {

        $query = "SELECT rate FROM options";
        $get_rate = $this->connexion->prepare($query);
        $get_rate->setFetchMode(PDO::FETCH_ASSOC);
        $get_rate->execute();

        $get_options_rate =  $get_rate->fetchAll();

        return $get_options_rate;
    }

    public function UpdateRate($set, $table, $rate1, $rate2) {

        $query = "UPDATE :table " ;

        $query .= $set ;

        echo $query;

        $data = [
            'table'=> $table,
            'rate1'=> $rate1,
            'rate2'=>$rate2,
        ] ;

       

        $update_rate = $this->connexion->prepare($query);
        $update_rate->execute($data);









    }


}