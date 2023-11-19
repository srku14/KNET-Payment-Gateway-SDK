<?php
error_reporting(1);
?>
<html>
	<head>
		<title>Knet Merchant Demo</title>
		<meta http-equiv="pragma" content="no-cache">
</head>

<body >
<table width="100%" cellspacing="1" cellpadding="1">
   <tr>
    <td align="center" >
	<table width="70%" border="0" > 
		<tr><td align=center class="heading">
		</td>
		<td align="left" width="70%" class="heading"><strong>Knet Merchant Demo Shopping Center  -php</strong>
		<!-- This example displays the content of several ServerVariables. -->  

		</td>
		</tr>
	</table>
	</td>
  </tr>
  <tr>
    <td align="center" class="msg">
	

<?php

// get Data from the URL

$ResTranData= $_GET['trandata'];
$payment = [];
if($ResTranData !=null) {
  $termResourceKey="";
	//Decryption logice starts
	$decrytedData=decrypt($ResTranData,$termResourceKey);
  $data = explode('&', $decrytedData);
  // make the decrypted data in array
  foreach($data as $key){  
    $data = explode('=', $key);
    $arrr = array($data[0]=>$data[1]);
    $payment = array_merge($payment, $arrr);
  }
}

$result = isset($payment['result']) ? $payment['result'] : '';
$trackid = isset($payment['trackid']) ? $payment['trackid'] : '';
$PaymentID = isset($payment['paymentid']) ? $payment['paymentid'] : '';
$ref = isset($payment['ref']) ? $payment['ref'] : '';
$tranid = isset($payment['tranid']) ? $payment['tranid'] : '';
$amount = isset($payment['amt']) ? $payment['amt'] : '';
$trx_error = isset($payment['Error']) ? $payment['Error'] : '';
$trx_errortext = isset($payment['ErrorText']) ? $payment['ErrorText'] : '';
$postdate = isset($payment['postdate']) ? $payment['postdate'] : '';
$auth = isset($payment['auth']) ? $payment['auth'] : '';
$udf1 = isset($payment['udf1']) ? $payment['udf1'] : '';
$udf2 = isset($payment['udf2']) ? $payment['udf2'] : '';
$udf3 = isset($payment['udf3']) ? $payment['udf3'] : '';
$udf4 = isset($payment['udf4']) ? $payment['udf4'] : '';
$udf5 = isset($payment['udf5']) ? $payment['udf5'] : '';
?>
     
        Transaction Completed Successfully<br>
          Thank You For Your Order 
	</td>
  </tr>
  <tr>
    <td align="center">
<table width=70% border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" col="2">
  <tr>
    <td colspan="2" align="center" class="msg"><strong class="text">Transaction Details</strong></td>
  </tr>
  <?php if($trx_error != null || $trx_errortext != null) { ?>
  <tr>
    <td width=26% class="tdfixed">Error :</td>
    <td width=74% class="tdwhite"><?php echo "$trx_error - $trx_errortext"; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td width=26% class="tdfixed">Payment ID :</td>
    <td width=74% class="tdwhite"><?php echo $PaymentID; ?></td>
  </tr>
  <tr>
    <td class="tdfixed">Post Date :</td>
    <td class="tdwhite"><?php echo $postdate;?></td>
  </tr>
  <tr>
    <td class="tdfixed">Result Code :</td>
    <td class="tdwhite"><?php echo $result;?></td>
  </tr>
  <tr>
    <td class="tdfixed">Transaction ID :</td>
    <td class="tdwhite"><?php echo $tranid;?></td>
  </tr>
  <tr>
    <td class="tdfixed">Auth :</td>
    <td class="tdwhite"><?php echo $auth;?></td>
  </tr>
  <tr>
    <td class="tdfixed">Track ID :</td>
    <td class="tdwhite"><?php echo $trackid;?></td>
  </tr>
  <tr>
    <td class="tdfixed">Ref No :</td>
    <td class="tdwhite"><?php echo $ref;?></td>
  </tr>
  <tr>
    <td class="tdfixed">Amount :</td>
    <td class="tdwhite"><?php echo $amount;?></td>
  </tr>
  <tr>
    <td class="tdfixed">UDF1 :</td>
    <td class="tdwhite"><?php echo $udf1;?> </td>
  </tr>
  <tr>
    <td class="tdfixed">UDF2 :</td>
    <td class="tdwhite"><?php echo $udf2;?></td>
  </tr>
  <tr>
    <td class="tdfixed">UDF3 :</td>
    <td class="tdwhite"><?php echo $udf3;?></td>
  </tr>
  <tr>
    <td class="tdfixed">UDF4 :</td>
    <td class="tdwhite"><?php echo $udf4;?></td>
  </tr>
  <tr>
    <td class="tdfixed">UDF5 :</td>
    <td class="tdwhite"><?php echo $udf5;?></td>
  </tr>
  <tr>
    <td class="tdfixed">&nbsp; </td>
    <td class="tdwhite">

	</td>
  </tr>
</table></td>
  </tr>
</table>

<center>
</center>
		</body>
</html>

<?php
  //Decryption Method for AES Algorithm Starts

function decrypt($code,$key) { 
  $code = hex2ByteArray(trim($code));
  $code=byteArray2String($code);
  $iv = $key; 
  $code = base64_encode($code);
  $decrypted = openssl_decrypt($code, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
  return pkcs5_unpad($decrypted);
}
  
  
  function hex2ByteArray($hexString) {
    $string = hex2bin($hexString);
    return unpack('C*', $string);
  }


  function byteArray2String($byteArray) {
    $chars = array_map("chr", $byteArray);
    return join($chars);
  }


  function pkcs5_unpad($text) {
  $pad = ord($text[strlen($text)-1]);
  if ($pad > strlen($text)) {
      return false;	
  }
  if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
      return false;
  }
  return substr($text, 0, -1 * $pad);
  }

//Decryption Method for AES Algorithm Ends
?>

