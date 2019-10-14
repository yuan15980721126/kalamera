<?php

require_once BASE_PATH . '/api/payment/amazonpay/config.php';

class Amazonpay
{
    public $config = array();

    public function __construct($paymentConfig)
    {
        $this->config['returnURL'] = SHOP_SITE_URL . "/api/payment/amazonpay/return.php";
        $this->config['cancelReturnURL'] = SHOP_SITE_URL . "/api/payment/amazonpay/cancel.php";
        $this->config['currency_code'] = 'USD';
        $this->config = array_merge($this->config, $paymentConfig);
    }

    public function getHostedParameters($orderInfo)
    {
        // Mandatory fields
        $amount      = $orderInfo["api_pay_amount"];

        // Optional fields
        $currencyCode            = $this->config['currency_code'];
        $sellerNote              = "Kalamera's Products";
        $scope                   = $_REQUEST["scope"];
        $sellerOrderId           = $orderInfo["pay_sn"]; //YOUR_CUSTOM_ORDER_REFERENCE_ID
        $shippingAddressRequired = "false";
        $paymentAction           = "AuthorizeAndCapture"; // other values None,Authorize
        $merchantId              = $this->config['merchant_id'];
        $accessKey               = $this->config['access_key'];
        $secretKey               = $this->config['secret_key'];
        $lwaClientId             = $this->config['client_id'];
        $returnURL               = $this->config['returnURL'];
        $cancelReturnURL         = $this->config['cancelReturnURL'];

        // Getting the MerchantID/sellerID, MWS secret Key, MWS Access Key from the configuration file
        if ($merchantId == "") {
            throw new InvalidArgumentException("merchantId not set in the configuration file");
        }
        if ($accessKey == "") {
            throw new InvalidArgumentException("accessKey not set in the configuration file");
        }
        if ($secretKey == "") {
            throw new InvalidArgumentException("secretKey not set in the configuration file");
        }
        if ($lwaClientId == "") {
            throw new InvalidArgumentException("Login With Amazon ClientID is not set in the configuration file");
        }

        //Addding the parameters to the PHP data structure
        $parameters["accessKey"]               = $accessKey;
        $parameters["amount"]                  = $amount;
        $parameters["sellerId"]                = $merchantId;
        $parameters["returnURL"]               = $returnURL;
        $parameters["cancelReturnURL"]         = $cancelReturnURL;
        $parameters["lwaClientId"]             = $lwaClientId;
        $parameters["sellerNote"]              = $sellerNote;
        $parameters["sellerOrderId"]           = $sellerOrderId;
        $parameters["currencyCode"]            = $currencyCode;
        $parameters["shippingAddressRequired"] = $shippingAddressRequired;
        $parameters["paymentAction"]           = $paymentAction;
        $parameters["scope"]                   = $scope;
        Log::record('amazonpay请求参数'.json_encode($parameters),Log::ERR);

        uksort($parameters, 'strcmp');

        //call the function to sign the parameters and return the URL encoded signature
        $Signature = $this->generateRequestSignature($parameters, $secretKey);

        //add the signature to the parameters data structure
        $parameters["signature"] = $Signature;

        //echoing the parameters will be picked up by the ajax success function in the front end
        return (json_encode($parameters));
    }

    /**
     * 生成签名
     *
     * @param [type] $parameters
     * @param [type] $secretKey
     * @return void
     */
    public function generateRequestSignature(array $parameters, $secretKey)
    {
        return _urlencode(_signParameters($parameters, $secretKey));
    }

    public function validateSignature($get)
    {

        unset($get['model']);
        unset($get['fun']);

        $signatureReturned = $get['signature'];
        $parameters = $get;
        unset($parameters['signature']);

        $secretKey               = $this->config['secret_key'];
        $returnURL = $this->config['returnURL'];
        if(isset($parameters['sellerOrderId'])) {
            $parameters['sellerOrderId'] = rawurlencode($parameters['sellerOrderId']);
        }
        uksort($parameters, 'strcmp');

        $parseUrl = parse_url($returnURL);
        $stringToSign = "GET\n" . $parseUrl['host'] . "\n" . $parseUrl['path'] . "\n";

        foreach ($parameters as $key => $value) {
            $queryParameters[] = $key . '=' . str_replace('%7E', '~', rawurlencode($value));
        }
        $stringToSign .= implode('&', $queryParameters);

        $signatureCalculated = base64_encode(hash_hmac("sha256", $stringToSign, $secretKey, true));
        $signatureCalculated = str_replace('%7E', '~', rawurlencode($signatureCalculated));

        if ($signatureReturned == $signatureCalculated) {
            return true;
        }
        
        return false;

    }

}


function _signParameters(array $parameters, $key)
{
    $stringToSign = null;
    $algorithm    = "HmacSHA256";
    $stringToSign = _calculateStringToSignV2($parameters);

    return _sign($stringToSign, $key, $algorithm);
}

function _calculateStringToSignV2(array $parameters)
{
    $data = 'POST';
    $data .= "\n";
    $data .= "payments.amazon.com";
    $data .= "\n";
    $data .= "/";
    $data .= "\n";
    $data .= _getParametersAsString($parameters);
    return $data;
}

function _getParametersAsString(array $parameters)
{
    $queryParameters = array();
    foreach ($parameters as $key => $value) {
        $queryParameters[] = $key . '=' . _urlencode($value);
    }
    return implode('&', $queryParameters);
}

function _urlencode($value)
{
    return str_replace('%7E', '~', rawurlencode($value));
}

function _sign($data, $key, $algorithm)
{
    if ($algorithm === 'HmacSHA1') {
        $hash = 'sha1';
    } else if ($algorithm === 'HmacSHA256') {
        $hash = 'sha256';
    } else {
        throw new Exception("Non-supported signing method specified");
    }
    return base64_encode(hash_hmac($hash, $data, $key, true));
}

