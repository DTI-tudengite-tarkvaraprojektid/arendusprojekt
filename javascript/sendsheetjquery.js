
document.addEventListener('DOMContentLoaded', function () {
    $("#editPage").hide()
    let reader = new FileReader();
    inputFile.addEventListener("change", function(e){
    reader.readAsArrayBuffer(e.target.files[0])
    reader.onload = function(e){

            var data = new Uint8Array(reader.result)
            var workbook = XLSX.read(data, {type:"array"})
            var first_sheet = workbook.SheetNames[0] // leiab esimese sheedi nime

            var worksheet = workbook.Sheets[first_sheet]
            jsonText = XLSX.utils.sheet_to_json(worksheet)
            jsonString = JSON.stringify(jsonText)
            console.log(jsonString)
            console.log("Kas on JSON: " + isJson(JSON.stringify(jsonText)))

            var htmlstr = XLSX.write(workbook, {sheet: first_sheet, type: "binary", bookType:"html"})
            $("#output")[0].innerHTML += htmlstr;
        }
    })
})

function clearInput(){
    $("#clearButton").click(function(){
        $("#inputFile").val("")
        $("#output")[0].innerHTML = "";
    })
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function sendJSON(){
    $("#editPage").show()
    $.ajax({
        url: "data.php",
        method: "POST",
        data:{data:jsonString},
        success:function(data){
            $("#alert_message").html('<div class="alert alert-success">'+ "Andmed lisatud!" +'</div>')
        }
    })

    setInterval(function(){
        $('#alert_message').html('');
    }, 5000)
}

function goToEdit(){
    window.open("editdata.html")
}
