<?php
require 'config.php';

    if(isset($_POST["student_id"])){  
        $output = '';  
        $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $query = "SELECT * FROM Opilased WHERE id = '".$_POST["student_id"]."'";
        $stmt = $conn-> prepare("SELECT marge FROM Markmed WHERE Opilaseid=?");
        $stmt -> bind_param("s", $_POST["student_id"]);
        $stmt ->execute();
        $stmt ->store_result();
        $stmt ->bind_result($note);
        while ($stmt->fetch()) {
            echo "%s %s\n". $note;
        }
        
        $result = mysqli_query($conn, $query);  
        $output .= '  
        <div class="table-responsive">  
            <table class="table table-bordered">';  
        while($row = mysqli_fetch_array($result)){  
            $output .= '  
                <tr>  
                        <td width="30%"><label>Perekonnanimi</label></td>  
                        <td width="70%">'.$row["pnimi"].'</td>  
                </tr>  
                <tr>  
                        <td width="30%"><label>Eesnimi</label></td>  
                        <td width="70%">'.$row["enimi"].'</td>  
                </tr>  
                <tr>  
                        <td width="30%"><label>Isikukood</label></td>  
                        <td width="70%">'.$row["idkood"].'</td>  
                </tr>  
                <tr>  
                        <td width="30%"><label>E-post</label></td>  
                        <td width="70%">'.$row["email"].'</td>  
                </tr>  
                <tr>  
                        <td width="30%"><label>TLU e-post</label></td>  
                        <td width="70%">'.$row["email_kool"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Üliõpilaskood</label></td>  
                    <td width="70%">'.$row["opilaskood"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Õppekava versioon</label></td>  
                    <td width="70%">'.$row["oppekava"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Spetsialiseerumise nimetus</label></td>  
                    <td width="70%">'.$row["suund"].'</td>  
                    </tr>
                    <tr>  
                    <td width="30%"><label>Finantseerimisallikas</label></td>  
                    <td width="70%">'.$row["finants"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Tasumata arveid summas:</label></td>  
                    <td width="70%">'.$row["tasumata_arved"].'</td>
                <tr>  
                    <td width="30%"><label>Õppekoormus</label></td>  
                    <td width="70%">'.$row["koormus"].'</td>  
                </tr>  
                <tr>  
                    <td width="30%"><label>SEM</label></td>  
                    <td width="70%">'.$row["sem"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Akadeemilisel puhkusel</label></td>  
                    <td width="70%">'.$row["puhkusel"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Välisõppes semestrite arv</label></td>  
                    <td width="70%">'.$row["valisoppe_sem"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Lõpetamise etapis</label></td>  
                    <td width="70%">'.$row["etapp"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>EAP</label></td>  
                    <td width="70%">'.$row["eap"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>KKH AP</label></td>  
                    <td width="70%">'.$row["kkh_ap"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>KKH EAP</label></td>  
                    <td width="70%">'.$row["kkh_eap"].'</td>  
                </tr>  
                <tr>  
                    <td width="30%"><label>KKH Kõik tulemused</label></td>  
                    <td width="70%">'.$row["kkh_koik"].'</td>  
                </tr>
                <tr>
                    <td width="30%"><label>Märkmed</label></td>
                    <td width="70%">'.$note.'</td>
                </tr>
                ';  
        }  
        $output .= "</table></div>";  
        echo $output; 
        $stmt ->free_result();
        $stmt ->close(); 
    }  
?>