<?php

    // Be sure your webserver is configured to never display the contents of this file under any circumstances.
    // The secret_key value below should be protected and never shared with anyone.

    $amazonpay_config = array(
        'merchant_id'   => 'A2N1OHBTQF2JP9', // Merchant/SellerID
        'access_key'    => 'AKIAJBHVERPARN6GWXGA', // MWS Access Key
        'secret_key'    => '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', // MWS Secret Key
        'client_id'     => 'amzn1.application-oa2-client.d1caea55b688434b91f6b23c3f9fc54c', // Login With Amazon Client ID
        'region'        => 'us',  // us, de, uk, jp
        'currency_code' => 'USD', // USD, EUR, GBP, JPY
        'sandbox'       => true
    ); // Use sandbox test mode

function getWidgetsJsURL($config)
{
    if ($config['sandbox']){
        $sandbox = "sandbox/";
    }else{
        $sandbox = "";
    }
    switch (strtolower($config['region'])) {
        case "us":
            return "https://static-na.payments-amazon.com/OffAmazonPayments/us/" . $sandbox . "js/Widgets.js";
            break;
        case "uk":
            return "https://static-eu.payments-amazon.com/OffAmazonPayments/gbp/" . $sandbox . "lpa/js/Widgets.js";
            break;
        case "jp":
            return "https://static-fe.payments-amazon.com/OffAmazonPayments/jp/" . $sandbox . "lpa/js/Widgets.js";
            break;
        default:
            return "https://static-eu.payments-amazon.com/OffAmazonPayments/eur/" . $sandbox . "lpa/js/Widgets.js";
            break;
    }
}

?>
