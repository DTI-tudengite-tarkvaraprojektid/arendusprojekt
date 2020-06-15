<?php
    session_start();
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    require 'config.php';
    echo session_id();
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    if(isset($_POST["noteDataStudent"])){
        echo 'VAATA: ' .$_SESSION['userId'];
        $stmt2 = $conn -> prepare("INSERT INTO Markmed (id,marge) VALUES(?,?)
         ON DUPLICATE KEY UPDATE marge = VALUES(marge)");
        $stmt2 -> bind_param("is", $_SESSION['userId'], $_POST['noteDataStudent']);
        $stmt2 -> execute();
        $stmt2 -> close();

    } else {
        echo 'Märge puudu';
    }


?>