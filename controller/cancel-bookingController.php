<?php 

require('../model/classes/class_reservations.php');

$cancelled = 0;

if (isset($_POST['confirmcancel'])){

    $cancel_booking = new Reservations;
    $cancel_booking->Cancel();
    unset ($_SESSION['id_reservation']);
    $cancelled = 1;
    
}

?>