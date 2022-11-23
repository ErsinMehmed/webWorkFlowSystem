function loadXMLDocc() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "app/checkStock.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDocc();
}, 1000);

function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText != "0") {
                document.getElementById("reloadBtnn").classList.add("has-noti");
                document.getElementById("reloadBtnn").classList.add("reloadBtnEff");
            } else {
                document.getElementById("reloadBtnn").classList.remove("has-noti");
                document.getElementById("reloadBtnn").classList.remove("reloadBtnEff");
            }
        }
    };
    xhttp.open("GET", "app/hasSomething.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc();
}, 1000);

function loadXMLDoccc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != "0") {
                document.getElementById("reloadBtnn").classList.add("has-noti");
                document.getElementById("reloadBtnn").classList.add("reloadBtnEff");
            } else {
                document.getElementById("reloadBtnn").classList.remove("has-noti");
                document.getElementById("reloadBtnn").classList.remove("reloadBtnEff");
            }
        }
    };
    xhttp.open("GET", "app/hasOrder.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoccc();
}, 1000);