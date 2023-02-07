<?php
class Tretman{
    public $id_tretmana;	
    public $naziv_tretmana;	
    public $trajanje;	
    public $cena;	
    public $vrsta;	

    public function __construct($id_tretmana=null, $naziv_tretmana=null, $trajanje=null, $cena=null, $vrsta=null){
        $this->id_tretmana = $id_tretmana;
        $this->naziv_tretmana = $naziv_tretmana;
        $this->trajanje = $trajanje;
        $this->cena = $cena;
        $this->vrsta=$vrsta;
    }
    
    public static function vratiSve(mysqli $conn){
        $query="SELECT * FROM tretmani t JOIN vrste_usluga v ON t.id_usluge=v.id_usluge";
        return $conn->query($query);
    }

    public static function dodajTretman(Tretman $novi_tretman, mysqli $conn){
	
        $query = "INSERT INTO tretmani (naziv_tretmana, trajanje, cena, id_usluge) VALUES
         ('$novi_tretman->naziv_tretmana', '$novi_tretman->trajanje','$novi_tretman->cena', '$novi_tretman->vrsta') ";
   
        return $conn->query($query);
	}


    public static function delete_tretman(mysqli $con)
    {
      
        $del_id = $_POST['del_id'];
        $query = "DELETE FROM tretmani 
                  WHERE id_tretmana = '$del_id'";
        $result = mysqli_query($con, $query);
        if($result){
            echo 'Tretman je obrisan';
        }else{
            echo 'Please Check Your Query';
        }
    }

    public static function getById($id_tretmana, mysqli $conn)
    {
        $q = "SELECT * FROM tretmani WHERE id_tretmana=$id_tretmana";
        $myArray = array();
        if ($result = $conn->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

  


    
    public static function izmeniTretman($naziv_tretmana, $trajanje, $cena, $vrsta, $edit_id_p, mysqli $conn){
        
        $query = "UPDATE tretmani 
                  SET naziv_tretmana ='$naziv_tretmana', trajanje='$trajanje', cena='$cena', id_usluge='$vrsta'
                  WHERE id_tretmana = '$edit_id_p'";
                  
     return $conn->query($query);
    }

    public static function pretraga(mysqli $conn){

        $query = "SELECT *
                  FROM tretmani t JOIN vrste_usluga v ON t.id_usluge=v.id_usluge
                  WHERE v.naziv_usluge LIKE '%".$_POST["search"]."%'";

        return $conn->query($query);

    }

   

}

?>