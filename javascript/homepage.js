$(document).ready(function(){
    fetchData()
    fetchNotes()

   // fetchStudentNotes()
    
    $("#cancel").hide()

    function fetchNotes(){
        var notesBox = $('#noteAreaPersonal');
        $.ajax({
            url: "php/getnotes.php",
            method: "POST",
            success: function(data){
                notesBox.val(data)
                console.log(data)
            }
        })
    }

    // Fetch  Student notes ---  POLE VAJA //

    function fetchStudentNotes(){
        var notesBox = $('#noteArea');
        $.ajax({
            url: "php/getstudentnotes.php",
            method: "POST",
            success: function(data){
                notesBox.val(data)
                console.log(data)
            }
        })
    }

    //datatable plugin parameetrid, täidab tabeli andmebaasi andmetega 
    function fetchData(){
        var dataTable = $("#students_right").dataTable({
            "processing" : true,
            "serverSide" : true,
            "paging": false,
            "info": false,
            scrollY: 400,
            scrollX: 0,
            columnDefs:[{
                
                className: 'select-checkbox',
                targets: 0,
                checkboxes: {
                    selectRow: true
                }
            }],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            "language" : {
                "search" : "Otsi: ",
            },
            "order" : [1, 'asc'],
            "ajax" : {
                url : "php/sidebar.php",
                type : "POST"
            }
        })
    }

    $(document).on("click", ".view_data", function(){
        var student_id = $(this).attr("id");
        $.ajax({
            url: 'php/select.php',
            method: 'post',
            data: {student_id: student_id},
            success: function(data){
                $('#savenote').hide();
                $('#student_info').html(data)
                $('#dataModal').modal("show")
            }
        })  
    })

    // Save personal notes to database
    $(document).on("click", "#saveButtonPersonal", function(){
        var noteDataPersonal = $("#noteAreaPersonal").val()
        console.log(noteDataPersonal)
        $.ajax({
            url: 'php/savenotes.php',
            method: 'post',
            data: {noteDataPersonal: noteDataPersonal},
            success: function(){
                window.alert("Märge salvestatud")
            }
        })
    })
    $(document).on("click", "#showcheckbox", function(){
                console.log("kohal")
        $('.checkbox').toggle()
    })

    // save student notes to database
    $('#savestudentnotes').on('click', function() { 
        var array = []
        var studentNote = $("#noteArea").val() 
        $("input:checkbox[name=type]:checked").each(function(){ 
            array.push($(this).attr('id')) 
        }) 
        array2 = Object.assign({}, array);
        console.log(JSON.stringify(array2))
        $.ajax({
            url:'php/studentnotes.php',
            method: 'POST',
            data: {array: JSON.stringify(array2), note: studentNote},
            success:function(data){
                $('#alert_message').html('<div class="alert alert-success">'+data+'</div>')
            }
        })
            
        
    })

    $(document).on("click", ".changenote", function(){
        $('#savenote').toggle();
        var currentnote = $(this).closest('td').next()
        var id = $(this).attr("id")
        console.log(id)
        $(currentnote).attr("contenteditable", "true")
        $('#savenote').on('click', function(){
            var notedata = currentnote.text()
            console.log(notedata)
            $.ajax({
                url: "php/updatenote.php",
                method: "POST",
                data: {id: id, new_note: notedata}
            })
        })

    })
    
    // Show different tabs
    

        $('.tabs-menu a').click(function (event) {
          event.preventDefault()
    
          // Toggle active class on tab buttons
          $(this).parent().addClass('current')
          $(this).parent().siblings().removeClass('current')
    
          // display only active tab content
          var activeTab = $(this).attr('href')
          $('.tab-content').not(activeTab).css('display', 'none')
          $(activeTab).fadeIn()
        })
    
    

   //document.getElementById("tab-1").click();
        



})


