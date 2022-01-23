<?php 
session_start();
require ('classes/class_reservations.php');
require ('classes/class_user.php');
require ('bdd.php');

$betweener = new Reservations;
var_dump($betweener->BetweenDates());

?>