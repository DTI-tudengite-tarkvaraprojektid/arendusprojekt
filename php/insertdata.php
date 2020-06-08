<?php
require 'config.php';

$myFile = "database.txt";
$fileHandle = fopen($myFile, "a+");

$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

if(isset($_POST["name"],$_POST["field"],$_POST["studentid"],$_POST["email"])){
    // teeb puhta stringi sellest jsonist mis ajaxiga saadeti
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $field = mysqli_real_escape_string($conn, $_POST["field"]);
    $studentid = mysqli_real_escape_string($conn, $_POST["studentid"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $query = "INSERT INTO Students(name, field, studentid, email) VALUES('$name', '$field', '$studentid', '$email')";
    $datatofile = json_encode($name . ' ' . $field . ' ' . $studentid . ' ' . $email);

    if($conn->query($query)){
        fwrite($fileHandle, ("Lisatud: " . $datatofile . "| Kuupäev: ". date('Y-m-d', $_SERVER['REQUEST_TIME']). "\n"));
        echo 'Andmed sisestatud';
    }
}

fclose($fileHandle);


?>