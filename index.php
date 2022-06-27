<?php
/**
 *  Main input form
 */


include('./includes/ini.inc.php');

mt_srand((double)microtime() * 1000000);
$sTransID = (string)mt_rand();
$sTransID .= date("yzGis");

include('./includes/_header.inc.php');
?>
<section>
    <h1>Request Parameters</h1>
    <form method="post" action="payment.php">
        <table border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td align="right"><label for="TransID"><?php echo $stdTransID; ?></label></td>
                <td><input type=text id="TransID" name=TransID value="<?php echo $sTransID; ?>" size=30></td>
            </tr>
            <tr>
                <td align="right"><label for="Amount"><?php echo $stdAmount; ?></td>
                <td><input type=text id="Amount" name=Amount value="<?php echo $iAmount; ?>" size=10></td>
            </tr>
            <tr>
                <td align="right"><label for="Currency"><?php echo $stdCurrency; ?></td>
                <td><input type=text id="Currency" name=Currency value="<?php echo $sCurrency; ?>" size=3></td>
            </tr>
            <tr>
                <td align="right"><label for="URLSuccess"><?php echo $stdSuccess; ?></td>
                <td><input type=text id="URLSuccess" name=URLSuccess value="<?php echo $sURLSuccess; ?>" size=50></td>
            </tr>
            <tr>
                <td align="right"><label for="URLFailure"><?php echo $stdFailure; ?></td>
                <td><input type=text id="URLFailure" name=URLFailure value="<?php echo $sURLFailure; ?>" size=50></td>
            </tr>
            <tr>
                <td align="right"><label for="URLNotify"><?php echo $stdNotify; ?></td>
                <td><input type=text id="URLNotify" name=URLNotify value="<?php echo $sURLNotify; ?>" size=50></td>
            </tr>
            <tr>
                <td align="right"><label for="OrderDesc"><?php echo $stdOrder; ?></td>
                <td><input type=text id="OrderDesc" name=OrderDesc value="<?php echo $sOrderDesc; ?>" size=50></td>
            </tr>
            <tr>
                <td align="right"><label for="UserData"><?php echo $stdUserdata; ?></td>
                <td><input type=text id="UserData" name=UserData value="<?php echo $sUserData; ?>" size=50></td>
            </tr>
            <tr>
                <td colspan=2>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp; </td>
                <td><input type=submit value=" <?php echo $stdInpSend; ?> "></td>
            </tr>
        </table>
    </form>
</section>
</body>
</html>
