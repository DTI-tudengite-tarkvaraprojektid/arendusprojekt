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
})
