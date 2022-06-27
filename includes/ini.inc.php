<?php
/**
 * This file contains basic configuration values.
 * IMPORTANT: This file is used only for demonstration purpose.
 *            Configuration parameters should be stored properly and secure!
 */

/*
 * Paygate credentials
 */
$MerchantID = "Your MerchantID";                // via e-mail from computop support
$BlowfishPassword = "Your Blowfish Password";   // via phone from computop support
$HmacPassword = "Your HMAC Password";           // via phone from computop support


/*
 * Initial values for main form
 */
$iAmount = 11;
$sCurrency = "EUR";
$sUrlDirname = strlen(dirname($_SERVER["PHP_SELF"])) > 1 ? dirname($_SERVER["PHP_SELF"]) : "";
$sUrlDirname = "https://$_SERVER[HTTP_HOST]" . $sUrlDirname;
$sURLSuccess = $sUrlDirname . "/success.php";
$sURLFailure = $sUrlDirname . "/failure.php";
$sURLNotify = $sUrlDirname . "/notify.php";
$sOrderDesc = "your order description";
$sUserData = "your user data";

$sthPayGate = "PHP - PayGate";
$stdTransID = "TransID";
$stdAmount = "Amount";
$stdCurrency = "Currency";
$stdSuccess = "Success-URL";
$stdFailure = "Failure-URL";
$stdNotify = "Notify-URL";
$stdOrder = "Order&nbsp;description";
$stdUserdata = "User&nbsp;data";
$stdInpSend = "Select Payment";


/*
 * Initial values for payment selection
 */
$stdPayType = "PayType";
$defPayType = 0;        // preselected PayType

$sPayType[0] = "Credit Card Form";
$sPayType[1] = "Direct Debit Form";
$sPayType[2] = "PayPal";
$sPayType[3] = "giropay";
$sPayType[4] = "Sofort";

$sURL[0] = "https://www.computop-paygate.com/payssl.aspx";
$sURL[1] = "https://www.computop-paygate.com/payelv.aspx";
$sURL[2] = "https://www.computop-paygate.com/paypal.aspx";
$sURL[3] = "https://www.computop-paygate.com/giropay.aspx";
$sURL[4] = "https://www.computop-paygate.com/sofort.aspx";


/*
 * Example for notification log
 */
$filename = "./notifylog/urlnotify.log";


/*
 * Text values for status
 */
$text['nodata'] = "No data found!";
$text['paymentfailed'] = "Payment failed!";
$text['paymentsuccessful'] = "Payment successful!";
$text['unknownstatus'] = "Unknown status!";
