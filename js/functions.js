function showNews() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show").innerHTML =
            this.responseText;
        }
    };
    xmlhttp.open("GET", "newsdata.php", true);
    xmlhttp.send();
}


function getNews() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show").innerHTML =
            this.responseText;
        }
    };
    xmlhttp.open("GET", "../php/getnews.php", true);
    xmlhttp.send();
}


function searchNews(searchterm) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show").innerHTML =
            this.responseText;
        }
    };
    xmlhttp.open("GET", "newsdata.php?search="+searchterm, true);
    xmlhttp.send();
}