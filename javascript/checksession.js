$(document).ready(function(){
    $.ajax({
        url: "php/checksession.php",
        method:"post",
        success: function(data){
            if(data != 'hea'){
                window.location.replace("login.php"); 
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
                window.location.replace("login.php"); 
            }
        })
    })
})
