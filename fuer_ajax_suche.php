<!DOCTYPE html>
<html>
<body>

<h2>Ajax Suche für Restaurant</h2>
<td><input name="restaurant" id="check" type="text" placeholder="Restaurant suchen"></td>
<div id="gebeaus">


    <button type="button" onclick="loadDoc()">Inhalt der php</button>
</div>

<script>
    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("gebeaus").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "index.php?search=" + document.getElementById('check').value + "&action=search&area = restaurant&search", true);
        xhttp.send();

    }
</script>

</body>
</html>
