<?php
require '../dbBroker.php';
require '../model/vrste_usluga.php';
require '../model/tretman.php';


$vrsta=Vrsta::vratiSve($conn);

if(isset( $_POST['naziv_tretmana']) && $_POST['naziv_tretmana'] !== "" && isset( $_POST['trajanje']) &&  $_POST['trajanje'] !== "" && isset( $_POST['cena']) && $_POST['cena'] !== "" && isset( $_POST['vrsta'])){
	        
	$nov_tretman=new Tretman(null, $_POST['naziv_tretmana'], $_POST['trajanje'], $_POST['cena'], $_POST['vrsta']);
		
	$status = Tretman::dodajTretman($nov_tretman,$conn);

   
    if($status){
        echo "uspesno";
    }else{
        echo "neuspesno";
    }
        
}

?>

