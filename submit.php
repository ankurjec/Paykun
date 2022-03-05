<?php
require 'Payment.php';
require 'Validator.php';
require 'Crypto.php';

$fname          = $_POST['full_name'];
$product_name   = $_POST['product_name'];
$email          = $_POST['email'];
$amount         = $_POST['amount'];
$contact        = $_POST['contact'];
$country        = $_POST['country'];
$state          = $_POST['state'];
$city           = $_POST['city'];
$postalcode     = $_POST['postalcode'];
$address        = $_POST['address'];
/**


*  Parameters requires to initialize an object of Payment are as follow.


*  mid => Merchant Id provided by Paykun


*  accessToken => Access Token provided by Paykun


*  encKey =>  Encryption provided by Paykun


*  isLive => Set true for production environment and false for sandbox or testing mode


*  isCustomTemplate => Set true for non composer projects, will disable twig template


*/

$obj = new \Paykun\Checkout\Payment('052964072573528', '1346A49BC161250ED14D937F380E3FA4', '8B7A11ED41F918142BCEF8B5B5293E21', false, true);
$successUrl = str_replace("request.php", "success", $_SERVER['HTTP_REFERER']);
$failUrl 	= str_replace("request.php", "failed", $_SERVER['HTTP_REFERER']);

/* Initializing Order*/

$obj->initOrder(generateByMicrotime(), $product_name,  $amount, $successUrl,  $failUrl, 'USD');

/*Add Customer*/


$obj->addCustomer($fname, $email, $contact);

/* Add Shipping address*/
$obj->addShippingAddress('', '', '', '', '');
$obj->addBillingAddress('', '', '', '', '');
/* Add Billing Address*/
/*Enable if require custom fields*/

$obj->setCustomFields(array('udf_1' => 'Some Dummy text'));

/*Render template and submit the form*/
echo $obj->submit();

/* Check for transaction status


* Once your success or failed url called then create an instance of Payment same as above and then call getTransactionInfo like below


*  $obj = new Payment('merchantUId', 'accessToken', 'encryptionKey', true, true); //Second last false if sandbox mode


*  $transactionData = $obj->getTransactionInfo(Get payment-id from the success or failed url);


*  Process $transactionData as per your requirement


*


* */
function generateByMicrotime() {
        $microtime = str_replace('.', '', microtime(true));
        return (substr($microtime, 0, 14));
}


?>
