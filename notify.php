<?php
/**
 * File       : notify.php
 * Description: see CompuTop PayGate documentation and result.inc.php
 * Important note: the NOTIFY is always performed with a POST-Request and blowfish-encrypted data!
 *
 */


// required constants

include('./includes/function.inc.php');

$filetitle = "Notify";
$filename = "./notifylog/urlnotify.log";             // this is an example. Database preferred.
$dat = date("d.m.Y H:i:s");
$row = "\n\n-------------- " . $dat . " --------------\n";


// obtain input values (for form method="POST")

$Data = $_POST["Data"];
$Len = $_POST["Len"];


// decrypt the data string

$myPayGate = new ctPaygate;
$plaintext = $myPayGate->ctDecrypt($Data, $Len, $BlowfishPassword);


// prepare notify log

$a = "";
$a = explode('&', $plaintext);
$info = $myPayGate->ctSplit($a, '=');
$TransID = $myPayGate->ctSplit($a, '=', 'TransID');
$Status = $myPayGate->ctSplit($a, '=', 'Status');
$PayID = $myPayGate->ctSplit($a, '=', 'PayID');
$Type = $myPayGate->ctSplit($a, '=', 'Type');
$UserData = $myPayGate->ctSplit($a, '=', 'UserData');
$row .= "\nTransID:\t" . $TransID;
$row .= "\nStatus:\t\t" . $Status;
$row .= "\nPayID:\t\t" . $PayID;
$row .= "\nType:\t\t" . $Type;
$row .= "\nUserData:\t" . $UserData;


// check transmitted decrypted status
$realstatus = $myPayGate->ctRealstatus($Status);


// example: writing into a logfile instead of using a database
if (!file_exists($filename)) {
    $fp = fopen($filename, "w");
    fclose($fp);
}

$fpn = @fopen($filename . ".tmp", "w");

if ($fpn <= 0) {
    $realstatus .= "\nerror writing logfile $filename.tmp\n";
}

$row .= "\nRealstatus:\t" . $realstatus;
fputs($fpn, $row);
$fp = @fopen($filename, "r");

if ($fp <= 0) {
    $realstatus .= "\nerror reading logfile $filename\n";
}

while (!feof($fp)) {
    $zeile = fgets($fp, 32000);
    fputs($fpn, $zeile);
}

fclose($fp);
fclose($fpn);
unlink($filename);
rename($filename . ".tmp", $filename);


// response
echo "Done writing to file";

