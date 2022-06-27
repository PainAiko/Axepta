<?php
/**
 * Selection of the payment after the main parameters have been set
 */


// required constants
include('./includes/function.inc.php');


// read data (for form method="POST")
$TransID = $_POST["TransID"];
$Amount = $_POST["Amount"];
$Currency = $_POST["Currency"];
$OrderDesc = $_POST["OrderDesc"];
$URLSuccess = $_POST["URLSuccess"];
$URLFailure = $_POST["URLFailure"];
$URLNotify = $_POST["URLNotify"];
$UserData = $_POST["UserData"];

// fixed  values
$Response = "encrypt";
$Capture = "AUTO";

// set currency to standard if empty
$Currency = trim($Currency);
if (empty($Currency)) {
    $Currency = $sCurrency;
}


// format data which is to be transmitted - required
$pTransID = "TransID=$TransID";
$pAmount = "Amount=$Amount";
$pCurrency = "Currency=$Currency";
$pURLSuccess = "URLSuccess=$URLSuccess";
$pURLFailure = "URLFailure=$URLFailure";
$pURLNotify = "URLNotify=$URLNotify";
$pOrderDesc = "OrderDesc=$OrderDesc";
$pUserData = "UserData=$UserData";
$pCapture = "Capture=$Capture";
$pResponse = "Response=$Response";

//Creating MAC value
$myPayGate = new ctPaygate;
$MAC = $myPayGate->ctHMAC("", $TransID, $MerchantID, $Amount, $Currency, $HmacPassword);
$pMAC = "MAC=$MAC";

$query = array($pTransID, $pAmount, $pCurrency, $pURLSuccess, $pURLFailure, $pURLNotify, $pOrderDesc, $pUserData, $pCapture, $pResponse, $pMAC);

// building the string MerchantID, Len and Data (encrypted)
$plaintext = join("&", $query);
$Len = strlen($plaintext);  // Length of the plain text string

// encrypt plaintext
$Data = $myPayGate->ctEncrypt($plaintext, $Len, $BlowfishPassword);


// prepare javascript array

$jsURL = implode(';', $sURL);

include('./includes/_header.inc.php');
?>
<section>
    <h1>Select Payment</h1>
    <script language="JavaScript">

        function pay_submit(arrURL) {

            var sURL = arrURL.split(";");

            for (var i = 0; i < sURL.length; i++) {

                if (document.ctForm.PayType.options[document.ctForm.PayType.selectedIndex].value == i) {
                    document.ctForm.action = sURL[i];
                }
            }

            document.ctForm.submit();
        }

    </script>
    <form method=post action=decrypt.php name=ctForm>
        <input type=hidden name=MerchantID value="<?php echo $MerchantID; ?>">
        <input type=hidden name=Data value="<?php echo $Data; ?>">
        <input type=hidden name=Len value="<?php echo $Len; ?>">
        <table border=0 cellspacing=0 cellpadding=5>
            <tr>
                <th colspan="2" class="title">Submit Request</th>
            </tr>
            <tr>
                <td align="right"><label for="PayType">Paytype:</label></td>
                <td>
                    <select id="PayType" name=PayType>

                        <?php
                        $i = 0;

                        foreach ($sPayType as $selPayType) {

                            if ($i == $defPayType) {
                                echo "<option value=\"$i\" selected>$selPayType</option>";

                            } else {
                                echo "<option value=\"$i\">$selPayType</option>";
                            }

                            $i++;
                        }
                        ?>

                    </select>
                    <input type=button onclick="pay_submit('<?php echo $jsURL; ?>');" value="Submit Request">
                </td>
            </tr>
            <tr>
                <td colspan=2>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <th colspan="2" class="title">Query Parameter</th>
            </tr>
            <tr>
                <td align="right"><?php echo $stdTransID; ?>:</td>
                <td><?php echo $TransID; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdAmount; ?>:</td>
                <td><?php echo $Amount; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdCurrency; ?>:</td>
                <td><?php echo $Currency; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdSuccess; ?>:</td>
                <td><?php echo $URLSuccess; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdFailure; ?>:</td>
                <td><?php echo $URLFailure; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdNotify; ?>:</td>
                <td><?php echo $URLNotify; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdOrder; ?>:</td>
                <td><?php echo $OrderDesc; ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo $stdUserdata; ?>:</td>
                <td><?php echo $UserData; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center" class="title">Set values</td>
            </tr>
            <tr>
                <td align="right">MerchantID:</td>
                <td><?php echo $MerchantID; ?></td>
            </tr>
            <tr>
                <td align="right">Response:</td>
                <td><?php echo $Response; ?></td>
            </tr>
            <tr>
                <td align="right">Capture:</td>
                <td><?php echo $Capture; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center" class="title">Derived values</td>
            </tr>
            <tr>
                <td align="right">MAC:</td>
                <td><?php echo $MAC; ?></td>
            </tr>
            <tr>
                <td align="right">Query:</td>
                <td><?php echo $plaintext; ?></td>
            </tr>
            <tr>
                <td align="right">Len:</td>
                <td><?php echo $Len; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center" class="title">Encrypted data</td>
            </tr>
            <tr>
                <td align="right">Data:</td>
                <td><?php echo $Data; ?></td>
            </tr>
        </table>
    </form>
</section>
</body>
</html>
