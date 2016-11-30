<?php
class PaypalSubscription{


    private $username;
    private $password;
    private $signature;
    private $offers;
    private $endpoint;
    private $sandbox;

    public function __construct($username, $password, $signature, $offers, $sandbox = true) {

        $this->username = $username;
        $this->password = $password;
        $this->signature = $signature;
        $this->offers = $offers;
        $this->endpoint = "https://api-3t." . ($sandbox ? "sandbox." : "") ."paypal.com/nvp";
        $this->sandbox = $sandbox;
    }

    public function nvp ($options = []){
        $curl = curl_init();
        $data = [
            'USER' => $this->username,
            'PWD' => $this->password,
            'SIGNATURE' => $this->signature,
            'METHOD' => 'SetExpressCheckout',
            'VERSION' => 86,
        ];
        $data = array_merge($data, $options);
        curl_setopt_array($curl,[
            CURLOPT_URL => $this->endpoint,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($data)
        ]);
        $response = curl_exec($curl);
        $responseArray = [];
        parse_str($response, $responseArray);
        return $responseArray;
    }

    public function subscribe($offer_id){
        if(!isset($this->offers[$offer_id])){
            throw new Exception('Cette offre n\'existe pas');
        }
        $offer = $this->offers[$offer_id];
        $data = [
            'METHOD' => 'SetExpressCheckout',
            'PAYMENTREQUEST_0_AMT' => $offer['price'],
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
            'PAYMENTREQUEST_0_CUSTOM' => $offer_id,
            "L_BILLINGTYPE0" => 'RecurringPayments',
            "L_BILLINGAGREEMENTDESCRIPTION0" => $offer['name'],
            'cancelUrl' => 'http://localhost/cartomagie/subscribe.php',
            'returnUrl' => 'http://localhost/cartomagie/process.php'
        ];
        $response = $this->nvp($data);
        if(!isset($response['TOKEN'])){
            throw new Exception($response['L_LONGMESSAGE0']);
        }
        $token = $response['TOKEN'];
        $url = "https://www." . ($this->sandbox ? "sandbox." : "") ."paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=$token";
        header('Location: '. $url);
    }

    public function getCheckoutDetail($token){
        $data = [
            'METHOD' => 'GetExpressCheckoutDetails',
            'TOKEN' => $token
        ];
       return $this->nvp($data);
    }

    public function doSuscribe($token){
        $detail = $this->getCheckoutDetail($token);
        $offer_id = $detail['PAYMENTREQUEST_0_CUSTOM'];
        if(!isset($response['TOKEN'])){
            throw new Exception($response['L_LONGMESSAGE0']);
        }
        $offer = $this->offers[$offer_id];
        $period = $offer['period'] === 'Month' ? new DateInterval('P1M') : new DateInterval('P1Y');
        $start = (new DateTime())->add($period)->getTimestamp();
        $response = $this->nvp([
            'METHOD' => 'CreateRecurringPaymentsProfile',
            'TOKEN' => $token,
            'PAYERID' => $detail['PAYERID'],
            'DESC' => $offer['name'],
            'AMT' => $offer['price'],
            'BILLINGPERIOD' => $offer['period'],
            'BILLINGFREQUENCY' => 1,
            'CURRENCYCODE' => 'EUR',
            'COUNTRYCODE' => 'FR',
            'MAXFAILEDPAYMENTS' => 3,
            'PROFILESTARTDATE' => gmdate("Y-m-d\TH:i:s\Z", $start),
            'INITAMT' => $offer['price'],
        ]);
        if($response['ACK'] === 'Success'){
            var_dump($response, $detail, $offer);
        }else{
            throw new Exception($response['L_LONGMESSAGE0']);
        }
    }

}
