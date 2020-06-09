<?php
    require 'config.php';

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    //$conn  = mysqli_connect($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $columns = array(
        "pnimi", "enimi", "idkood", "email", "opilaskood","oppekava",
        "suund","finants","tasumata_arved","koormus","sem","puhkusel",
        "valisoppe_sem","etapp","etapp","eap","kkh_ap","kkh_eap","kkh_koik"
    );

    $query = "SELECT * FROM Opilased";

    if(isset($_POST["search"]["value"])){
        $query .= '
            WHERE pnimi LIKE "%'.$_POST["search"]["value"].'%"
            OR enimi LIKE "%'.$_POST["search"]["value"].'%"
            OR idkood LIKE "%'.$_POST["search"]["value"].'%"
            OR email LIKE "%'.$_POST["search"]["value"].'%"
            OR opilaskood LIKE "%'.$_POST["search"]["value"].'%"
            OR oppekava LIKE "%'.$_POST["search"]["value"].'%"
            OR suund LIKE "%'.$_POST["search"]["value"].'%"
            OR finants LIKE "%'.$_POST["search"]["value"].'%"
            OR tasumata_arved LIKE "%'.$_POST["search"]["value"].'%"
            OR koormus LIKE "%'.$_POST["search"]["value"].'%"
            OR sem LIKE "%'.$_POST["search"]["value"].'%"
            OR puhkusel LIKE "%'.$_POST["search"]["value"].'%"
            OR valisoppe_sem LIKE "%'.$_POST["search"]["value"].'%"
            OR etapp LIKE "%'.$_POST["search"]["value"].'%"
            OR eap LIKE "%'.$_POST["search"]["value"].'%"
            OR kkh_ap LIKE "%'.$_POST["search"]["value"].'%"
            OR kkh_eap LIKE "%'.$_POST["search"]["value"].'%"
            OR kkh_koik LIKE "%'.$_POST["search"]["value"].'%"
        ';
    }

    if(isset($_POST["order"])){
        $query .= 
         'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
        ';
    } else {
        $query .= 'ORDER BY id DESC ';
    }

    $query1 = '';
    /*
    if($_POST["length"] != -1){
        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'] . ';';
    }
    */

    $number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));



    //$result = $conn->query($query . $query1);
    $result = mysqli_query($conn, $query . $query1);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
      
    $array = array();

    while($row = mysqli_fetch_array($result)){
        $sub_array = array();
        $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="enimi">' . $row["enimi"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="pnimi">' . $row["pnimi"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="oppekava">' . $row["oppekava"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="opilaskood">' . $row["opilaskood"] . '</div>';
        $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="email_kool">' . $row["email_kool"] . '</div>';
        $sub_array[] = '<button type="button" class="btn btn-primary view_data"  id="'.$row["id"].'">Profiil</button> <button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Kustuta</button> <button type="button" class="btn btn-light" id="id="'.$row["id"].'"">Muuda</button>';
        //$sub_array[] = ';
        $array[] = $sub_array; 
    }

    function getAllData(){
        $query = "SELECT * FROM Students";
        //$result = $conn->query($query);
        $result = mysqli_query($GLOBALS['conn'], $query);
        return mysqli_num_rows($result);
    }

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" =>  getAllData($conn),
        "recordsFiltered" => $number_filter_row,
        "data" => $array
    );

    echo json_encode($output);




?>