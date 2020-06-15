$(document).ready(function(){
    fetchData()
    fetchNotes()
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
    $(document).on("click", "#saveButtonStudent", function(){
        var noteDataStudent = $("#noteAreaStudent").val()
        console.log(noteDataStudent)
        $.ajax({
            url: 'php/savenotes.php',
            method: 'post',
            data: {noteDataStudent: noteDataStudent},
            success: function(){
                window.alert("Märge salvestatud")
            }
        })
    })
    $(document).on("click", "#showcheckbox", function(){
                console.log("kohal")
        $('.checkbox').toggle()
    })



})

// Show different tabs

$(document).ready(function () {
    $('.tabs-menu a').click(function (event) {
      event.preventDefault();

      // Toggle active class on tab buttons
      $(this).parent().addClass('current');
      $(this).parent().siblings().removeClass('current');

      // display only active tab content
      var activeTab = $(this).attr('href');
      $('.tab-content').not(activeTab).css('display', 'none');
      $(activeTab).fadeIn();
    });
  });
    