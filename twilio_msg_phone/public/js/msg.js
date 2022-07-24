function openForm() {
    // document.querySelector('#msgDiv').classList.add('token-visible');
    document.getElementById("msgDiv").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
function msgVisible() {
    location.reload();
        document.getElementById("msgDiv").style.display = "block";
        // document.getElementById("sbmtBt").style.display = "block";
        // document.getElementById("nextButton").style.display = "none";
        // document.getElementById("formFileErrorMsg").innerHTML = "";
        // document.getElementById("tokenErrMsg").innerHTML = "";
}