$(document).ready(function(){
    fetchData()
    fetchNotes()
    $("#cancel").hide()

    function fetchNotes(){
        var notesBox = $('#noteArea');
        $.ajax({
            url: "php/getnotes.php",
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
            "language" : {
                "search" : "Otsi: ",
            },
            "order" : [],
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
                $('#student_info').html(data)
                $('#dataModal').modal("show")
            }
        })  
    })

    $(document).on("click", "#saveButton", function(){
        var noteData = $("#noteArea").val()
        console.log(noteData)
        $.ajax({
            url: 'php/savenotes.php',
            method: 'post',
            data: {noteData: noteData},
            success: function(){
                window.alert("Märge salvestatud")
            }
        })
    })

})
    