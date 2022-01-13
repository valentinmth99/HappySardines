<?php 
session_start();
include ('classes/class_reservations.php');

$test = new Reservations;
$test->ListingUserBookings();