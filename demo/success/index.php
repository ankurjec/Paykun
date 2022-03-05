<?php

require '../../src/Payment.php';
require '../../src/Crypto.php';
require '../../src/Validator.php';


$obj = new \Paykun\Checkout\Payment('110465786620960', '27374C69DC7280483982DC6DCC3CD40E', '6E4A37C1104ACCB7FD1D67D69FD0B3DB', false, false);
$response = $obj->getTransactionInfo($_REQUEST['payment-id']);

var_dump($response);
if(is_array($response) && !empty($response)) {

    if($response['status'] && $response['data']['transaction']['status'] == "Success") {
        echo "Transaction success";
    } else {
        echo "Transaction failed";
    }
}

?>