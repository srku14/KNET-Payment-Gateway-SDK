
# KNET Payment PHP SDK (RAW Method)

KNET has introduced a new flow in the KNET payment gateway integration for the certification of MIDs that were issued or onboarded after September 2023. However, there are no changes in the integration flow for existing MIDs that were certified and issued by KNET before September 2023.

In the new KNET Integration Flow, the Merchant Notification (Response Notification "REDIRECT=ResultURL") method of integration is now required for all new merchants. This change only applies to the response leg, while the initialization process remains unchanged. With this merchant notification method, it is necessary for the merchant to have a valid SSL certificate installed and synced with KNET. This ensures a handshake between KNET and the merchant when delivering the transaction response. If the handshake fails due to SSL mismatch, network issues, or an incorrect acknowledgement returned to KNET, a reversal will be initiated, and an error will be displayed to the customer on the payment page.

The code base supports KNET RAW method integration. Please update the credentials such as $TranportalId, $ReqTranportalPassword & $termResourceKey on the PHP pages SendPerformREQuest.php & result.php.

Please refer GetHandlerResponse.php where "REDIRECT=ResultURL" change is implemented.


