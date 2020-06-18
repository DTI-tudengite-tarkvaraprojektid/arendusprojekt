<?php


    require 'config.php';
    require 'functions_main.php';

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);



    if(!empty($_POST)){
        $output = '';

        if ($_POST["id"] != '') {
            $stmt = $conn->prepare(
           "UPDATE Opilased   
            SET pnimi= ?,enimi= ?,idkood= ?,email= ?,email_kool= ?,opilaskood= ?,oppekava= ?,suund= ?,finants= ?,tasumata_arved= ?,koormus= ?,sem= ?,
            puhkusel= ?,valisoppe_sem= ?,etapp= ?,eap= ?,kkh_ap= ?,kkh_eap= ?,kkh_koik= ? WHERE id = ?
            ");
            $stmt->bind_param('sssssssssssssssssssi',test_input($_POST["lname"]),test_input($_POST["fname"]),test_input($_POST["idcode"]),test_input($_POST["email"])
            ,test_input($_POST["email_school"]),test_input($_POST["student_id"]),test_input($_POST["field"]),test_input($_POST["spec"]),test_input($_POST["finance"])
            ,test_input($_POST["unpaid"]),test_input($_POST["load"]),test_input($_POST["sem"]),test_input($_POST["break"]),test_input($_POST["abroad"])
            ,test_input($_POST["finish"]),test_input($_POST["eap"]),test_input($_POST["kkh_ap"]),test_input($_POST["kkh_eap"]),test_input($_POST["kkh_all"])
            ,test_input($_POST['id']));
            $stmt->execute();
            $message = 'Andmed uuendatud';  
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO Opilased (pnimi, enimi, idkood, email, email_kool, opilaskood, oppekava,
                suund, finants, tasumata_arved, koormus, sem, puhkusel, valisoppe_sem, etapp, eap, kkh_ap, kkh_eap, kkh_koik) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
            );
            $stmt->bind_param('sssssssssssssssssss'test_input($_POST["lname"]),test_input($_POST["fname"]),test_input($_POST["idcode"]),test_input($_POST["email"])
            ,test_input($_POST["email_school"]),test_input($_POST["student_id"]),test_input($_POST["field"]),test_input($_POST["spec"]),test_input($_POST["finance"])
            ,test_input($_POST["unpaid"]),test_input($_POST["load"]),test_input($_POST["sem"]),test_input($_POST["break"]),test_input($_POST["abroad"])
            ,test_input($_POST["finish"]),test_input($_POST["eap"]),test_input($_POST["kkh_ap"]),test_input($_POST["kkh_eap"]),test_input($_POST["kkh_all"]));
            $done = $stmt->execute();
            $message = 'Andmed lisatud';
        }
        
       
        if($done) {  

            //$output .= '<label class="text-success">Andmed sisestatud!</label>';  
            $select_query = "SELECT * FROM Opilased ORDER BY id DESC";  
            $result = mysqli_query($conn, $select_query);
            $row = mysqli_fetch_array($result);            
            $output .= '  
                    <table class="table table-bordered">  
                    <tr>
                        <td>Eesnimi</td>
                        <td>Perekonnanimi</td>
                        <td>Õppekava</td>
                        <td>Üliõpilaskood</td>
                        <td>TLU email</td>
                        <td></td>
                    </tr>
            ';  
                while($row = mysqli_fetch_array($result)){  
                        $output .= '
                        <tr>
                            <td><div class="update" data-id="'.$row["id"].'" data-column="enimi">' . $row["enimi"] . '</div></td>
                            <td><div class="update" data-id="'.$row["id"].'" data-column="pnimi">' . $row["pnimi"] . '</div></td>
                            <td><div class="update" data-id="'.$row["id"].'" data-column="oppekava">' . $row["oppekava"] . '</div></td>
                            <td><div class="update" data-id="'.$row["id"].'" data-column="opilaskood">' . $row["opilaskood"] . '</div></td>
                            <td><div class="update" data-id="'.$row["id"].'" data-column="email_kool">' . $row["email_kool"] . '</div></td>
                            <td><button type="button" class="btn btn-primary view_data"  id="'.$row["id"].'">Profiil</button> <button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Kustuta</button> <button type="button" class="btn btn-light" id="id="'.$row["id"].'"">Muuda</button></td>
                        </tr>
                        ';  
                }  
            $output .= '</table>';  
        } else {
            echo $conn -> error;
        }
        echo $output;
    }  

?>