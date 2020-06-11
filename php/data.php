<?php

    require 'config.php';

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
                    "sssssssssssssssssss", $allData[$x][$results[0]],$allData[$x][$results[1]], $allData[$x][$results[2]], 
                    $allData[$x][$results[3]], $allData[$x][$results[4]],$allData[$x][$results[5]],$allData[$x][$results[6]],$allData[$x][$results[7]],
                    $allData[$x][$results[8]],$allData[$x][$results[9]],$allData[$x][$results[10]],$allData[$x][$results[11]],$allData[$x][$results[12]],
                    $allData[$x][$results[13]],$allData[$x][$results[14]],$allData[$x][$results[15]],$allData[$x][$results[16]],$allData[$x][$results[17]],
                    $allData[$x][$results[18]]);

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
    
    
        // ---------- statements ------------



        //$stmt2 = $conn -> prepare("SELECT * FROM Opilased WHERE opilaskood = ?");

        //$stmt2 = $conn -> prepare("SELECT CASE WHEN EXISTS (SELECT * FROM Opilased WHERE opilaskood = ?) THEN 'TRUE' ELSE 'FALSE' END");

        /*$stmt3 = $conn -> prepare(" UPDATE Opilased SET pnimi= ?,enimi= ?,idkood= ?,email= ?,
        email_kool= ?,oppekava= ?,suund= ?,finants= ?,tasumata_arved= ?,koormus= ?,sem= ?,
        puhkusel= ?,valisoppe_sem= ?,etapp= ?,eap= ?,kkh_ap= ?,kkh_eap= ?,kkh_koik= ? WHERE opilaskood = ?");
        */

            /*
            echo $allData[$x][$results[5]];
            $stmt2 -> bind_param("s", $allData[$x][$results[5]]);
            $result2 = $stmt2 -> execute();
            
            
            $stmt2->store_result();
            $needs_editing = $stmt2->fetch();
            echo 'asdas' .mysqli_num_rows($needs_editing);
            print_r( 'VAATA!!!:' .$needs_editing);
            $stmt2 -> close();
            $conn->next_result();
            $needs_editing -> close();
            
            
            if($needs_editing){
                $stmt2->free_result();
                $stmt2 -> close();
                echo 'uuendab';
                $stmt3 -> bind_param("sssssssssssssssssss", $allData[$x][$results[0]],$allData[$x][$results[1]], $allData[$x][$results[2]], 
                $allData[$x][$results[3]], $allData[$x][$results[4]],$allData[$x][$results[6]],$allData[$x][$results[7]],
                $allData[$x][$results[8]],$allData[$x][$results[9]],$allData[$x][$results[10]],$allData[$x][$results[11]],$allData[$x][$results[12]],
                $allData[$x][$results[13]],$allData[$x][$results[14]],$allData[$x][$results[15]],$allData[$x][$results[16]],$allData[$x][$results[17]],
                $allData[$x][$results[18]],$allData[$x][$results[5]]);
                $stmt3 -> execute();
                $stmt3->store_result();
                //$conn->next_result();
                $x++;
            } else {
                $stmt2->free_result();
                $stmt2 -> close();
                echo 'lisab';
                echo $conn -> error;
                $stmt -> bind_param(
                    "sssssssssssssssssss", $allData[$x][$results[0]],$allData[$x][$results[1]], $allData[$x][$results[2]], 
                    $allData[$x][$results[3]], $allData[$x][$results[4]],$allData[$x][$results[5]],$allData[$x][$results[6]],$allData[$x][$results[7]],
                    $allData[$x][$results[8]],$allData[$x][$results[9]],$allData[$x][$results[10]],$allData[$x][$results[11]],$allData[$x][$results[12]],
                    $allData[$x][$results[13]],$allData[$x][$results[14]],$allData[$x][$results[15]],$allData[$x][$results[16]],$allData[$x][$results[17]],
                    $allData[$x][$results[18]]);

                $result3 = $stmt -> execute();
                $stmt->store_result();
                $x++;
            } */
            

        
        
        if($result3){
            echo 'Andmed sisestatud!';
        }
        $conn -> close();
    }
        


        //$stmt -> close();
        //$stmt3 -> close();
        //$conn -> close();
        
    
    

    
    
?>