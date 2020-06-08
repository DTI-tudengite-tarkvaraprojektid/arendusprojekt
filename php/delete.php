<?php
require 'config.php';
$myFile = "database.txt";
$fileHandle = fopen($myFile, "a+");

$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

if(isset($_POST["id"])){
    $query = "DELETE FROM Students WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($conn, $query)){
        fwrite($fileHandle, ("Kustutatud id: " . $_POST["id"]. "\n"));
        echo 'Rida kustutatud!';
    }
}
fclose($fileHandle);

?>



