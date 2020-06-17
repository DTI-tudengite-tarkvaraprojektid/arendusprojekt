<?php
    session_start();
    unset($_SESSION["loggedin"]);
    unset($_SESSION["userId"]);
    unset($_SESSION["username"]);
    //header("Location: ../login.php");
?>
