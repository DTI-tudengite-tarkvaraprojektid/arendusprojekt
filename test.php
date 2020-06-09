<?php
require 'php/config.php';
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$query = "SELECT * FROM Opilased ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<head>
    <script src="javascript/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="javascript/jquery.tabledit.js"></script>
    <script src="javascript/editsheet.js"></script>
    <script lang="javascript" src="javascript/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.1/cpexcel.js" integrity="sha256-W3rJZOZXlV1xks8sdGPOTRzqRS3Z09PwehXSQXEq0gU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">  
        <br />  
        <br />  
        <br />  
        <div class="table-responsive">  
         <h3 align="center">Live Table Data Edit Delete using Tabledit Plugin in PHP</h3><br />  
         <table id="editable_table" class="table table-bordered table-striped">
          <thead>
           <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
           </tr>
          </thead>
          <tbody>
          <?php
          while($row = mysqli_fetch_array($result))
          {
           echo '
           <tr>
            <td>'.$row["id"].'</td>
            <td>'.$row["enimi"].'</td>
            <td>'.$row["pnimi"].'</td>
            <td>'.$row["oppekava"].'</td>
            <td>'.$row["opilaskood"].'</td>
            <td>'.$row["email_kool"].'</td>
           </tr>
           ';
          }
          ?>
          </tbody>
         </table>
        </div>  
       </div>  
</body>
</html>
<script>  
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'action.php',
      columns:{
       identifier:[0, "id"],
       editable:[[1, 'enimi'], [2, 'pnimi'], [3, 'oppekava'], [4, 'opilaskood'], [5, 'email_kool']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      }
     });
 
});  
 </script>


