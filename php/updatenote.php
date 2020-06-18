<?php
    require 'config.php';
    require 'function_main.php';
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    if(isset($_POST["new_note"]) && isset($_POST["id"])){
        //echo 'VAATA:   '.$_POST["new_note"] . 'ID:   ' .$_POST["id"] ;
        $note =  test_input($_POST["new_note"]);
        $stmt = $conn -> prepare("UPDATE Markmed SET marge = ? WHERE Opilaseid = ?");
        $stmt -> bind_param("si", $note, $_POST["id"]);
        if($stmt -> execute()){
            echo "Märge uuendatud";
        } else {
            echo $conn->error;
        }

        $stmt -> close();
        
    } else {
        echo 'gugugu';
    }


?>