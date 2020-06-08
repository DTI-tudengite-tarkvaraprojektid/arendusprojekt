<?php
    require 'config.php';

    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    //$conn  = mysqli_connect($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $columns = array("name", "field", "studentid", "email");

    $query = "SELECT * FROM Students";

    if(isset($_POST["search"]["value"])){
        $query .= '
            WHERE name LIKE "%'.$_POST["search"]["value"].'%"
            OR field LIKE "%'.$_POST["search"]["value"].'%"
            OR studentid LIKE "%'.$_POST["search"]["value"].'%"
            OR email LIKE "%'.$_POST["search"]["value"].'%"
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
        $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="name">' . $row["name"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="field">' . $row["field"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="studentid">' . $row["studentid"] . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="email">' . $row["email"] . '</div>';
        $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Kustuta</button>';
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