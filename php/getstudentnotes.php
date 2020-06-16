<?php
    session_start();
    require 'config.php';
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT marge FROM Markmed WHERE Userid = ?");
    $stmt -> bind_param("i", $_SESSION['userId']);
    $stmt -> execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows();
    $stmt->bind_result($note);

    while ($stmt->fetch()) {
         echo $note;
    }
 
    $stmt->free_result();
 
    $stmt->close();

?>