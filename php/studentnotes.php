<?php
    require 'config.php';
    session_start();
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    if(isset($_POST["array"]) && isset($_POST["note"])){
        $stmt = $conn -> prepare("INSERT INTO Markmed (Userid, Opilaseid, marge) VALUES(?,?,?) ON DUPLICATE KEY UPDATE marge=CONCAT(marge, ?)");
        $object = json_decode($_POST['array'], TRUE);
        for ($i=0; $i < count($object); $i++) {

            if(!$stmt -> bind_param("isis",$_SESSION["userId"], $object[$i], $_POST["note"],$_POST["note"])){
                print_r($conn->error_list);
            }
            if(!$stmt -> execute()){
                print_r($conn->error_list);
            }
            
        }
    } else {
        echo 'sadsad';
    }
    $stmt -> close();


?>