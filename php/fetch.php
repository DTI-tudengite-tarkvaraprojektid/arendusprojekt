<?php

require 'config.php';
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

if(isset($_POST["student_id"]))  
{  
     $query = "SELECT * FROM Opilased WHERE id = '".$_POST["student_id"]."'";  
     $result = mysqli_query($conn, $query);  
     $row = mysqli_fetch_array($result);  
     echo json_encode($row);  
}  



?>