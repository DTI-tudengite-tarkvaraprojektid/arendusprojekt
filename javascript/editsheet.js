


$(document).ready(function(){
    fetchData()
    $("#cancel").hide()

    //datatable plugin parameetrid, täidab tabeli andmebaasi andmetega 
    function fetchData(){
        var dataTable = $("#studentInfo").dataTable({
            "processing" : true,
            "serverSide" : true,
            "language" : {
                "search" : "Otsi: "
            },
            "order" : [],
            "ajax" : {
                url : "php/getdata.php",
                type : "POST"
            }
        })
    }

    function updateData(id, columnname, value){
        $.ajax({
            url: "php/update.php",
            method: "POST",
            data:{id:id, columnname:columnname, value:value},
            success:function(data){
                $("#alert_message").html('<div class="alert alert-success">'+ data +'</div>')
                $('#studentInfo').DataTable().destroy();
                fetchData()
            }
        })
    
        setInterval(function(){
            $('#alert_message').html('');
        }, 5000)
    
    }

    
    $("#add").click(function(){
        var html = "<tr>"
        html += '<td contenteditable id="data1"></td>'
        html += '<td contenteditable id="data2"></td>'
        html += '<td contenteditable id="data3"></td>'
        html += '<td contenteditable id="data4"></td>'
        html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Sisesta</button></td>'
        html += '</tr>'
        $('#studentInfo tbody').prepend(html)
    })

    $(document).on('click', '#insert', function(){
        var name = $("#data1").text()
        var field = $("#data2").text()
        var studentid = $("#data3").text()
        var email = $("#data4").text()
        //var added = event.timeStamp;

        if(name != '' && field != '' && studentid != '' && email != ''){
            $.ajax({
                url:"php/insertdata.php",
                method:"POST",
                data:{name:name, field:field, studentid:studentid, email:email},
                success:function(data){
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>')
                    $('#studentInfo').DataTable().destroy()
                    fetchData()
                }
            })

            setInterval(function(){
                $('#alert_message').html('')
            }, 5000)

        } else {
         alert("Täida kõik väljad!")
        }
    })
   

    $(document).on("blur", ".update", function(){
        console.log("blurrr")
        var id = $(this).data("id")
        console.log("id: " + id)
        var columnname = $(this).data("column")
        var value = $(this).text()
        updateData(id, columnname, value)    
    })
    $(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        if(confirm("Kas olete kindel et soovite kustutada?")){
            $.ajax({
                url:"php/delete.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>')
                    $('#studentInfo').DataTable().destroy()
                    fetchData()
                }
            });

         setInterval(function(){
            $('#alert_message').html('')
         }, 5000)
        }
    })
})




