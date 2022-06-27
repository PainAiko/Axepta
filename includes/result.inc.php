<?php
/**
 * This file creates the output for success.php and failure.php
 */

include('function.inc.php');
include('_header.inc.php');

// check, if the data and len has been passed via POST, otherwise retrieve it from GET
if (empty($_GET["Data"]) || empty($_GET["Len"])) {
    $Data = $_POST["Data"];
    $Len = $_POST["Len"];
} else {
    $Data = $_GET["Data"];
    $Len = $_GET["Len"];
}


// decrypt the data string
$myPayGate = new ctPaygate;
$plaintext = $myPayGate->ctDecrypt($Data, $Len, $BlowfishPassword);


// prepare information string
$a = "";
$a = explode('&', $plaintext);
$info = $myPayGate->ctSplit($a, '=');
$Status = $myPayGate->ctSplit($a, '=', 'Status');


// check transmitted decrypted status

$realstatus = $myPayGate->ctRealstatus($Status);

echo "<section><h1>$filetitle</h1>";

// info output
include('html.inc.php');
?>
<!--  button to call notify locally -->
<script>
    function call_notify() {
        var http = new XMLHttpRequest();
        var url = "notify.php";
        var params = "<?php if (empty($_GET["Data"])) { print "Len=" . $_POST["Len"] . "&Data=" . $_POST["Data"];} elseif (empty($_POST["Data"])) { print "Len=" . $_GET["Len"] . "&Data=" . $_GET["Data"]; } ?>";
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.setRequestHeader("Content-length", params.length.toString());
        http.setRequestHeader("Connection", "close");
        http.send(params);
    }
</script>
<button onClick='call_notify();'>Call notify (locally)</button>

<!-- Close up html -->
</section></body></html>