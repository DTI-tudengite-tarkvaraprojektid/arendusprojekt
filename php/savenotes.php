<?php
    require 'config.php';
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    if(isset($_POST(['noteData']))){
        if(isset($_SESSION['userId'])){
            $stmt = $conn -> prepare("INSERT INTO Isiklik_marge (marge) VALUES (?) ON DUPLICATE KEY UPDATE marge = (?)");
            $stmt -> bind_param("ss", $_POST(['noteData'],$_POST(['noteData'])));
            echo $_POST(['noteData']);
        }
    } else {
        echo 'Sisesta märge';
    }




?>