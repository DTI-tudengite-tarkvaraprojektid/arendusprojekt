window.onload = init();

function init(){
    let inputButton = document.getElementById("#inputButton")
    let inputField = document.getElementById("#inputFile")
    let clearButton = document.getElementById("#clearButton")
    let editButton = document.getElementById("#editButton")
    var jsonText;
    var jsonString;
    var test = false;

}


let reader = new FileReader();
document.addEventListener('DOMContentLoaded', function () {
    $("#saveButton").hide()
    inputFile.addEventListener("change", function(e){
    $("#saveButton").show()
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
    clearButton.addEventListener("click", function(){
        inputFile.value = ""
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
    const xhr = new XMLHttpRequest();
    let editButton = document.getElementById("#editButton")
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $("#editPage").show()
            $("#alert_message").html('<div class="alert alert-success">'+ "Andmed lisatud!" +'</div>')
        }
    };
    xhr.open("POST", "php/data.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(jsonString);

}
function goToEdit(){
    window.open("editdata.html")
}
/*
function saveToFile(){
    //let JSONstring = JSON.stringify(todos);
    let newReq = new XMLHttpRequest();
    let url = "server.php?data=" + encodeURI(JSONstring);
    newReq.open("GET", url, true);
    newReq.setRequestHeader("Content-type", "text/plain;charset=UTF-8");
    newReq.send();
 }
 */


