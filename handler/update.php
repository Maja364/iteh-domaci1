<?php
require '../dbBroker.php';
require '../model/vrste_usluga.php';
require '../model/tretman.php';


if(isset($_POST['btnIzmeni']) ){


    $naziv_tretmana = $_POST['up_naziv_tretmana'];
    $trajanje = $_POST['up_trajanje'];
    $cena = $_POST['up_cena'];
    $vrsta = $_POST['up_vrsta'];
    $id_tretmana = $_POST['edit_id_p'];

    $result = Tretman::izmeniTretman($naziv_tretmana, $trajanje, $cena, $vrsta, $id_tretmana, $conn);

	
    if($result){
        echo 'Uspesno';
        header("Location: ../home.php");

    }else{
        echo 'Neuspesno';
        header("Location: ../home.php");
    }
}
	
	







?>