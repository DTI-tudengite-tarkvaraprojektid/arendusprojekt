<?php

    require 'config.php';
    require 'functions.php';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    $rawData = file_get_contents("php://input");
    $myData = urldecode($rawData);
    $object = json_decode($myData, true);
    
    
    storeStudentInfo($object);
    function storeStudentInfo($allData){
        $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

        print_r(array_chunk($allData, 2));
    
        $results = array();
        /*
        $yolo = array_keys($allData[0]);
        print_r($yolo);
        */
        
        foreach ($allData[0] as $key => $value) {
            $results[] = $key; 
        }
    
        //print_r('VAATA: ' .$results[5]);
        
    
        $stmt4 = $conn ->prepare("SELECT id FROM Opilased");
        //$result = $stmt4->execute();
        
        
        if($stmt4 ->execute()) {
            $stmt4 -> close();
            $stmt = $conn -> prepare("INSERT INTO Opilased (pnimi, enimi, idkood, email, email_kool, opilaskood, oppekava,
            suund, finants, tasumata_arved, koormus, sem, puhkusel, valisoppe_sem, etapp, eap, kkh_ap, kkh_eap, kkh_koik) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE pnimi= VALUES(pnimi),enimi= VALUES(enimi),idkood= VALUES(idkood),email= VALUES(email),
            email_kool= VALUES(email_kool),opilaskood = VALUES(opilaskood),oppekava= VALUES(oppekava),suund= VALUES(suund),finants= VALUES(finants),
            tasumata_arved= VALUES(tasumata_arved),koormus= VALUES(koormus),sem= VALUES(sem),puhkusel= VALUES(puhkusel),valisoppe_sem= VALUES(valisoppe_sem),
            etapp= VALUES(etapp),eap= VALUES(eap),kkh_ap= VALUES(kkh_ap),kkh_eap= VALUES(kkh_eap),kkh_koik= VALUES(kkh_koik)");

                $x = 0;
                while($x <= count($allData)  ) {
                    //$stmt2->free_result();
                    //$stmt2 -> close();
                    echo 'lisab';
                    echo $conn -> error;
                    $stmt -> bind_param(
                    "sssssssssssssssssss", test_input($allData[$x][$results[0]]),test_input($allData[$x][$results[1]]), test_input($allData[$x][$results[2]]), 
                    test_input($allData[$x][$results[3]]), test_input($allData[$x][$results[4]]),test_input($allData[$x][$results[5]]),test_input($allData[$x][$results[6]]),
                    test_input($allData[$x][$results[7]]),test_input($allData[$x][$results[8]]),test_input($allData[$x][$results[9]]),test_input($allData[$x][$results[10]]),
                    test_input($allData[$x][$results[11]]),test_input($allData[$x][$results[12]]),test_input($allData[$x][$results[13]]),test_input($allData[$x][$results[14]]),
                    test_input($allData[$x][$results[15]]),test_input($allData[$x][$results[16]]),test_input($allData[$x][$results[17]]),test_input($allData[$x][$results[18]]));

                    $result3 = $stmt -> execute();
                    //$stmt->store_result();
                    $x++;
                }
            $stmt->close();
        } else {
            $stmt4 -> close();
            $createDb = "CREATE TABLE Opilased (
                id INT AUTO_INCREMENT,
                pnimi VARCHAR(50) NOT NULL,
                enimi VARCHAR(50) ,
                idkood VARCHAR(50),
                email VARCHAR(50),
                email_kool VARCHAR(50),
                opilaskood VARCHAR(50) PRIMARY KEY NOT NULL,
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
                kkh_koik VARCHAR(20),
            )  ENGINE=INNODB;";
        echo 'create';
        $result = mysqli_query($conn, $createDb);
        }
    

        
        
        if($result3){
            echo 'Andmed sisestatud!';
        }
        $conn -> close();
    }
        

    
    
?>