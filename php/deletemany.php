<?php

    require 'config.php';
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    
    if(isset($_POST)){
        $object = json_decode($_POST['array'], TRUE);
        echo 'asd' . count($object);
        
        $x = '';

        //print_r(json_decode($_POST["array"], true));

        $stmt = $conn ->prepare("DELETE FROM Opilased WHERE id = ?");
        for ($i=0; $i < count($object); $i++) {

            $stmt -> bind_param("s", $object[$i]);
            $stmt -> execute();
        }
        
        echo 'Andmed kustutatud!';
        
    } else {
        echo 'ei tööta';
    }
    
    $stmt -> close();

    //echo 'Andmed kustutatud!';
        


?>