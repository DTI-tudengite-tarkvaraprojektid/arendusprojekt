$(document).ready(function(){
    $.ajax({
        url: "php/checksession.php",
        method:"post",
        success: function(data){
            if(data == 'halb'){
                window.location.replace("login.php");
            } else {
                console.log(data)
            }
            //console.log(data)
        }
    })
})
