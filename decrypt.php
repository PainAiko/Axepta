<?php
/**
 * File        : decrypt.php
 * Description : decrypting utility for internal test use
 *
 */


include('./includes/function.inc.php');
$filetitle = "decrypt.php";

// obtain input values (for form method="POST")

$Data = empty($_POST["Data"]) ? "" : $_POST["Data"];
$Len = empty($_POST["Len"]) ? "" : $_POST["Len"];

// decrypt the data string, if not empty
if (strlen($Data) > 0) {
    $myPayGate = new ctPaygate;
    $plaintext = $myPayGate->ctDecrypt($Data, $Len, $BlowfishPassword);

// prepare information string

    $a = "";
    $a = explode('&', $plaintext);
    $info = $myPayGate->ctSplit($a, '=');

}

// html output
include ('./includes/_header.inc.php');
?>
<section>
    <h1>Decrypt</h1>
</section>
<form method=post action=decrypt.php name=ctForm>
    <table border=0 cellspacing=0 cellpadding=5>
        <tr>
            <th colspan="2" class="title">Decrypt Data</th>
        </tr>
        <tr>
            <td><label for="Data">Data:</label></td>
            <td><input type=text id="Data" name=Data value="" size="100"></td>
        </tr>
        <tr>
            <td><label for="Len">Len:</label></td>
            <td><input type=text id="Len" name=Len value=""></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type=submit value="Decrypt"></td>
        </tr>

        <tr>
            <td colspan=2>&nbsp;</td>
        </tr>
        <tr>
            <td colspan=2></td>
        </tr>
        <tr>
            <th colspan="2" class="title">Query Parameters</th>
        </tr>
        <tr>
            <td>Data:</td>
            <td><?php echo $Data; ?></td>
        </tr>
        <tr>
            <td>Len:</td>
            <td><?php echo $Len ?></td>
        </tr>
        <?php if (strlen($Data) > 0) {
            ?>
            <tr>
                <td colspan=2>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <th colspan="2" class="title">Decrypted Parameters</th>
            </tr>

            <?php
            echo $info;
        }
        ?>
    </table>
</form>
</body>
</html>