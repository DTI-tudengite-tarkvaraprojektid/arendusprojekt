<?php


    require 'config.php';


    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    if(!empty($_POST)){
        // teeb puhta stringi sellest jsonist mis ajaxiga saadeti
        $output = '';
        $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
        $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
        $idcode = mysqli_real_escape_string($conn, $_POST["idcode"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $email_school = mysqli_real_escape_string($conn, $_POST["email_school"]);
        $studentid = mysqli_real_escape_string($conn, $_POST["student_id"]);
        $field = mysqli_real_escape_string($conn, $_POST["field"]);
        $spec = mysqli_real_escape_string($conn, $_POST["spec"]);
        $finance = mysqli_real_escape_string($conn, $_POST["finance"]);
        $unpaid = mysqli_real_escape_string($conn, $_POST["unpaid"]);
        $load = mysqli_real_escape_string($conn, $_POST["load"]);
        $sem = mysqli_real_escape_string($conn, $_POST["sem"]);
        $break = mysqli_real_escape_string($conn, $_POST["break"]);
        $abroad = mysqli_real_escape_string($conn, $_POST["abroad"]);
        $finish = mysqli_real_escape_string($conn, $_POST["finish"]);
        $eap = mysqli_real_escape_string($conn, $_POST["eap"]);
        $kkh_ap = mysqli_real_escape_string($conn, $_POST["kkh_ap"]);
        $kkh_eap = mysqli_real_escape_string($conn, $_POST["kkh_eap"]);
        $kkh_all = mysqli_real_escape_string($conn, $_POST["kkh_all"]);

        $query =  "INSERT INTO Opilased (pnimi, enimi, idkood, email, email_kool, opilaskood, oppekava,
                suund, finants, tasumata_arved, koormus, sem, puhkusel, valisoppe_sem, etapp, eap, kkh_ap, kkh_eap, kkh_koik) 
                VALUES('$lname','$fname','$idcode','$email','$email_school','$studentid','$field','$spec','$finance','$unpaid','$load','$sem','$break','$abroad','$finish','$eap','$kkh_ap','$kkh_eap','$kkh_all')";
        if(mysqli_query($conn, $query)) {  
            //$output .= '<label class="text-success">Andmed sisestatud!</label>';  
            $select_query = "SELECT * FROM Opilased ORDER BY id DESC";  
            $result = mysqli_query($conn, $select_query);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($con));
                exit();
            } 

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
        } 
     
        echo $output;
    }  

?>