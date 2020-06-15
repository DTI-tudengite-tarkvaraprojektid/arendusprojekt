<?php
    session_start();
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    require 'config.php';
    //echo session_id();
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    if(isset($_POST["noteDataPersonal"])){
        //echo 'VAATA: ' .$_SESSION['userId'];
        $stmt2 = $conn -> prepare("INSERT INTO Isiklik_marge (Userid,marge) VALUES(?,?)
         ON DUPLICATE KEY UPDATE marge = VALUES(marge)");
        $stmt2 -> bind_param("is", $_SESSION['userId'], $_POST['noteDataPersonal']);
        $stmt2 -> execute();
        $stmt2 -> close();
        /*
        if ($stmt2->execute()) {
            $stmt2->store_result();
            $stmt2 -> close();
            if ($stmt2->num_rows >= "1") {
               
                $stmt = $conn -> prepare("UPDATE Isiklik_marge SET marge = ? WHERE Userid = ?");
                $stmt -> bind_param("si", $_POST(['noteData'],$_SESSION(['userId'])));
                $stmt->execute();
                $stmt->close();
                echo $conn -> error;
            } else {
                
                $stmt = $conn -> prepare("INSERT INTO Isiklik_marge (marge, Userid) VALUES (?,?)");
                $stmt -> bind_param("si", $_POST['noteData'],$_SESSION['userId']);
                //print_r($conn->error_list);
                $stmt->execute();
                $stmt->close();
                

                echo $conn -> error;
            }
        }
        */
    } else {
        echo 'Märge puudu';
    }

    // Save student notes to database

    if(isset($_POST["noteDataStudent"])){
        //echo 'VAATA: ' .$_SESSION['userId'];
        $stmt2 = $conn -> prepare("INSERT INTO Markmed (Userid,marge) VALUES(?,?)
         ON DUPLICATE KEY UPDATE marge = VALUES(marge)");
        $stmt2 -> bind_param("is", $_SESSION['userId'], $_POST['noteDataStudent']);
        $stmt2 -> execute();
        $stmt2 -> close();
       
    } else {
        echo 'Märge puudu';
    }

    if(isset($_POST["noteDataStudent"])){
        //echo "Töötab!";
        $notice = ""; //See on  teade, mis antakse salvestamise kohta
        //loome ühenduse andmebaasiserveriga
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        //Valmistame ette SQL päringu
        $stmt = $mysqli->prepare("INSERT INTO Markmed (Userid, marge) VALUES (?,?)");
        echo $mysqli->error;
        $stmt2 -> bind_param("is", $_SESSION['userId'], $_POST['noteDataStudent']);
        if ($stmt->execute()) {
            $notice = 'Sõnum: "''" on salvestatud.'; 
        } 
        else { 
            $notice = "Sõnumi salvestamisel tekkis tõrge: ". $stmt->error; 
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }


?>