<?php

function login ($username, $password){
    $notice = "";
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $mysqli->prepare("SELECT password FROM Users WHERE username=?");  
    echo $mysqli->error;
    $stmt->bind_param("s", $username);
    $stmt->bind_result($passwordFromDb);
    if($stmt->execute()){
	  if($stmt->fetch()){
		//kasutaja leitud
		if(password_verify($password, $passwordFromDb)){
      
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT id, username FROM Users WHERE username=?");
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

function changePassword($oldPassword, $password){
    //vana parooli kontroll
    $notice = "";
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT password FROM Users WHERE id=?");
    echo $conn->error;
    $stmt->bind_param("i", $_SESSION["userId"]);
    $stmt->bind_result($passwordFromDb);
    if($stmt->execute()){
      if($stmt->fetch()){
        if(password_verify($oldPassword, $passwordFromDb)){
            $stmt->close();
            $stmt = $conn->prepare("UPDATE Users SET password = ? WHERE id = ?");
            $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
            $pwdhash = password_hash($password,PASSWORD_BCRYPT, $options );
            $stmt->bind_param("si", $pwdhash, $_SESSION["userId"]);
            if($stmt->execute()){
              $notice = "Uue parooli salvestamine õnnestus!";
            } else {
              $notice = "Parooli salvestamisel tekkis tehniline viga: " .$stmt->error;
            }
        } else {
            $notice = "Sisestasite vale parooli! Proovige uuesti!";
        }
            
      } else {
          $notice = "Tekkis viga (vale kasutaja id)!";
      }
    }
      $stmt->close();
      $conn->close();
    return $notice;
}