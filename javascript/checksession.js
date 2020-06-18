$(document).ready(function(){
    $.ajax({
        url: "php/checksession.php",
        method:"POST",
        success: function(data){
            if(data != 'hea'){
                window.location.replace("index.php"); 
                console.log(data)
            } else {
                console.log(data)
            }
        }
    })

    $('#logout').click(function(){
        $.ajax({
            url: "php/logout.php",
            method: "POST",
            success: function(){
                window.location.replace("index.php"); 
            }
        })
    })
})
