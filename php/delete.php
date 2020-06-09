<?php
require 'config.php';

$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

if(isset($_POST["id"])){
    $query = "DELETE FROM Opilased WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($conn, $query)){
        echo 'Rida kustutatud!';
    }
}
?>



