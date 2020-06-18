<?php
    require 'config.php';
    require 'function_main.php';
    session_start();
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    if(isset($_POST["array"]) && isset($_POST["note"])){
        $stmt = $conn -> prepare("INSERT INTO Markmed (Kasutajaid, Opilaseid, marge) VALUES(?,?,?) ON DUPLICATE KEY UPDATE marge=CONCAT(marge, ?)");
        $object = json_decode($_POST['array'], TRUE);
        $note = test_input($_POST["note"]);

        
        for ($i=0; $i < count($object); $i++) {

            if(!$stmt -> bind_param("isis",$_SESSION["userId"], $object[$i], $note,$note)){
                print_r($conn->error_list);
            }
            if(!$stmt -> execute()){
                print_r($conn->error_list);
            }
            
        }
        $stmt -> close();
    } else {
        echo $conn ->error;
    }
    

?>
