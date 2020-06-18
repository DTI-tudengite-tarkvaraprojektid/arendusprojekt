<?php

function login ($username, $password){
    $notice = "";
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $mysqli->prepare("SELECT parool FROM Kasutaja WHERE kasutajanimi=?");  
    echo $mysqli->error;
    $stmt->bind_param("s", $username);
    $stmt->bind_result($passwordFromDb);
    if($stmt->execute()){
	  if($stmt->fetch()){
		//kasutaja leitud
		if(password_verify($password, $passwordFromDb)){
      
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT id, kasutajanimi FROM Kasutaja WHERE kasutajanimi=?");
		  echo $mysqli->error;
		  $stmt->bind_param("s", $username);
		  $stmt->bind_result($idFromDb, $usernameFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  session_start();
      $_SESSION['loggedin'] = true;
		  $_SESSION["userId"] = $idFromDb;
		  $_SESSION["username"] = $usernameFromDb;
	
		  
		  $stmt->close();
      $mysqli->close();
      //echo $_SESSION['loggedin'] . ' ' . $_SESSION["userId"];
		  header("Location: home.html");
		  exit();
		  		  
		} else {
		  $notice = "Vale salasõna!";
		}
     }
    }
	
	$stmt->close();
	$mysqli->close();
	return $notice;
}



