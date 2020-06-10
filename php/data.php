<?php
    require 'config.php';

    $rawData = file_get_contents("php://input");
    $myData = urldecode($rawData);
    $object = json_decode($myData, true);

    storeStudentInfo($object);

    function storeStudentInfo($allData){

        print_r(array_chunk($allData, 2));
    
        $results = array();
        $yolo = array_keys($allData[0]);
    
        print_r($yolo);
        
        foreach ($allData[0] as $key => $value) {
            $results[] = $key; 
        }
    
        print_r($results[0]);
        $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    
        $query = "SELECT ID FROM Opilased";
        $result = mysqli_query($conn, $query);
        
        if(empty($result)) {
            $createDb = "CREATE TABLE Opilased (
                id INT AUTO_INCREMENT PRIMARY KEY,
                pnimi VARCHAR(50) NOT NULL,
                enimi VARCHAR(50) ,
                idkood VARCHAR(50),
                email VARCHAR(50),
                email_kool VARCHAR(50),
                opilaskood VARCHAR(50),
                oppekava VARCHAR(50),
                suund VARCHAR(50),
                finants VARCHAR(50),
                tasumata_arved VARCHAR(50),
                koormus VARCHAR(50),
                sem VARCHAR(50),
                puhkusel VARCHAR(50),
                valisoppe_sem VARCHAR(50),
                etapp VARCHAR(50),
                eap VARCHAR(20),
                kkh_ap VARCHAR(20),
                kkh_eap VARCHAR(20),
                kkh_koik VARCHAR(20)
            )  ENGINE=INNODB;";
            $result = mysqli_query($conn, $createDb);
        }
    
    
        $x = 0;
        while($x <= count() + 1) {
            $stmt = $conn -> prepare ("INSERT INTO Opilased (pnimi, enimi, idkood, email, email_kool, opilaskood, oppekava,
            suund, finants, tasumata_arved, koormus, sem, puhkusel, valisoppe_sem, etapp, eap, kkh_ap, kkh_eap, kkh_koik) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            echo $conn -> error;
            $stmt -> bind_param(
                "sssssssssssssssssss", $allData[$x][$results[0]],$allData[$x][$results[1]], $allData[$x][$results[2]], 
                $allData[$x][$results[3]], $allData[$x][$results[4]],$allData[$x][$results[5]],$allData[$x][$results[6]],$allData[$x][$results[7]],
                $allData[$x][$results[8]],$allData[$x][$results[9]],$allData[$x][$results[10]],$allData[$x][$results[11]],$allData[$x][$results[12]],
                $allData[$x][$results[13]],$allData[$x][$results[14]],$allData[$x][$results[15]],$allData[$x][$results[16]],$allData[$x][$results[17]],
                $allData[$x][$results[18]]
            );
            $stmt -> execute();
            $x++;
        }
        if($stmt -> execute()){
            echo 'Andmed sisestatud!';
        }
        

        //fclose($fileHandle);
        $stmt -> close();
        $conn -> close();
        
            
    
    }

    
    
?>