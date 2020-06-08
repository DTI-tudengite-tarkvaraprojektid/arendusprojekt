<?php
require 'config.php';
$myFile = "database.txt";
$fileHandle = fopen($myFile, "a+");

$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
//$conn  = mysqli_connect($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

if(isset($_POST["id"])){
    
    $value = mysqli_real_escape_string($conn, $_POST["value"]);
    $query = "UPDATE Students SET ".$_POST["columnname"]."='".$value."' WHERE id = '".$_POST["id"]."'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }

    if(mysqli_query($conn, $query)){
        fwrite($fileHandle, ("Muudetud: ID - " . $_POST["id"] . " tulp - ". $_POST["columnname"] . " väärtus- " . $value . "| Kuupäev: ". date('Y-m-d', $_SERVER['REQUEST_TIME']). "\n"));
        echo 'Andmed uuendatud!';
    }
} else {
    echo 'Viga andmete uuendamisel';
}
fclose($fileHandle);

?>