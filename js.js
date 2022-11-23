function loadXMLDocccc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("nofifyBox").innerHTML = xhttp.responseText;
            console.log(xhttp.responseText);
        }
    };
    xhttp.open("GET", "notiBox.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDocccc();
}, 1000);