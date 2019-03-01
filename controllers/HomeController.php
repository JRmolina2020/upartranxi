<?php
require_once'../model/User.php';
require_once'../model/Comparendo.php';


//instancias
$user = new user;
$comparendo = new Comparendo;


$ruser=$user->totalUser();
$re=$ruser->fetch_object();
$total=$re->total;

$rcom=$comparendo->totalComparendo();
$rec=$rcom->fetch_object();
$totalC=$rec->total;

$rcom2=$comparendo->totaldeuda();
$rec2=$rcom2->fetch_object();
$toti=$rec2->toti;
$toti=number_format($toti, 0, '', '.');

$rcom23=$comparendo->totalgrua();
$rec23=$rcom23->fetch_object();
$totu=$rec23->totu;
$totu=number_format($totu, 0, '', '.');

$rcom24=$comparendo->totalindividual();



?>