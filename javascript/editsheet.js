


$(document).ready(function(){
    fetchData()
    $("#cancel").hide()

    //datatable plugin parameetrid, täidab tabeli andmebaasi andmetega 
    function fetchData(){
        var dataTable = $("#studentInfo").dataTable({
            "processing" : true,
            "serverSide" : true,
            "language" : {
                "zeroRecords":    "Kirjed puuduvad",
                "info": "Kokku: _TOTAL_ | Kuvatud:  _START_ - _END_",
                "lengthMenu": "Näita _MENU_ kirjet",
                "search" : "Otsi: ",
                "paginate": {
                    "first":      "Esimene",
                    "last":       "Viimane",
                    "next":       "Järgmine",
                    "previous":   "Eelmine"
                },
            },
            /*
            select: {
                style: 'multi'
            },
            */
            "order" : [],
            "ajax" : {
                url : "php/getdata.php",
                type : "POST"
            }
        })
    }

    $('#deletemany').on('click', function() { 
        var array = []; 
        $("input:checkbox[name=type]:checked").each(function() { 
            array.push($(this).attr('id')); 
        }); 
        if(confirm("Kas olete kindel et soovite kustutada " + array.length + " rida?")){
            array2 = Object.assign({}, array);
            console.log(JSON.stringify(array2))
            $.ajax({
                url:'php/deletemany.php',
                method: 'POST',
                data: {array: JSON.stringify(array2)},
                success:function(data){
                    $('#alert_message').html('<div class="alert alert-success">'+data+'</div>')
                    $('#studentInfo').DataTable().destroy()
                    fetchData()
                }
            })
            
        }
    }); 

    function funCalled(obj) {
        var el = document.getElementById("parentImg");
      if (obj.checked) {
      
       el.className = "checked"; 
      } else {
          el.className = "notChecked";
      }
  }

    
    /*
    $(document).on("blur", ".update", function(){
        console.log("blurrr")
        var id = $(this).data("id")
        console.log("id: " + id)
        var columnname = $(this).data("column")
        var value = $(this).text()
        updateData(id, columnname, value)    
    })*/
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

    $(document).on("click", ".view_data", function(){
        var student_id = $(this).attr("id");
        $.ajax({
            url: 'php/select.php',
            method: 'post',
            data: {student_id: student_id},
            success: function(data){
                $('#student_info').html(data)
                $('#dataModal').modal("show")
                //console.log($('#student_info').html(data))
            }
        })  
    })

    
    $(document).on("click", ".edit_data", function(){
        var student_id = $(this).attr("id");
        console.log(student_id) 
        $.ajax({  
            url:"php/fetch.php",  
            method:"POST",  
            data:{student_id:student_id},  
            dataType:"json",  
            success:function(data){  
                 $('#lname').val(data.pnimi);  
                 $('#fname').val(data.enimi);  
                 $('#idcode').val(data.idkood);  
                 $('#email').val(data.email);  
                 $('#email_school').val(data.email_kool);  
                 $('#field').val(data.oppekava);  
                 $('#spec').val(data.suund);  
                 $('#finance').val(data.finants);  
                 $('#unpaid').val(data.tasuamata_arved);  
                 $('#load').val(data.koormus);
                 $('#sem').val(data.sem);  
                 $('#break').val(data.puhkusel);  
                 $('#abroad').val(data.valisoppe_sem);    
                 $('#finish').val(data.etapp);  
                 $('#eap').val(data.eap);
                 $('#kkh_ap').val(data.kkh_ap);    
                 $('#kkh_eap').val(data.kkh_eap);  
                 $('#kkh_all').val(data.kkh_koik);  
                 $('#id').val(data.id);

                 $('#insert').val("Uuenda");  
                 $('#add_data_Modal').modal('show');
                 
            }  
       });  
    })

    $('#insert_form').on("submit", function(event){  
        //event.preventDefault();  
        if($('#lname').val() == "" && $('student_id').val == "") {  
             alert("Perekonnanimi ja üliõpilaskood on kohustuslikud väljad!");  
        } else {  
             $.ajax({  
                  url:"php/insertdata.php",  
                  method:"POST",  
                  data:$('#insert_form').serialize(),  
                  beforeSend:function(){  
                    $('#insert').val("Inserting");  
                  },  
                  success:function(data){  
                    //$('#alert_message').html('<div class="alert alert-success">Andmed lisatud!</div>')
                    $('#insert_form')[0].reset();  
                    $('#add_data_Modal').modal('hide');
                    $('#studentInfo').html(data);  
                        
                }  
            });  
        }  
   });  



})




