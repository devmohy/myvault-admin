<?php

namespace App\Services;

use App\Models\User;
use App\Models\APIToken;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;
use Illuminate\Support\Facades\Http;
use App\Exceptions\PaystackServiceException;

class Paystack
{

    protected $http;
    protected $token;
    protected $baseUrl;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(Http $http)
    {
        $this->baseUrl = config("services.paystack.baseUrl");
        $this->setToken();
        $this->http = $http::withToken($this->token);

    }

    private function setToken()
    {

        $paystackCreds = APIToken::where('provider', 'PAYSTACK')->first();

        $this->token = $paystackCreds->token;
    }



    /**
     *
     */
    public function createCustomer($data)
    {

        try {
            $response = $this->http->post($this->baseUrl . "customer", $data);

            if ($response->failed()) {
                logger("Create customer call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while trying to Create customer");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Create customer connection timeout");
            throw new PaystackServiceException("Could not create customer");
        }

        if(!$response->json()['status']){
          logger($response->json()['message']);
          throw new PaystackServiceException($response->json()['message']);
        }
    
        logger("Create customer successful", ["body" => $response->json()]);
        return $response->json();
    }

    /**
     *
     */
    public function validateCustomer($customerCode, $data)
    {

        try {
            $response = $this->http->post($this->baseUrl . "customer/{$customerCode}/identification", $data);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            logger("Validate customer connection timeout");
            throw new PaystackServiceException("Could not Validate customer");
        }

        logger("Validate customer call successful", ["body" => $response->json()]);
        return $response->json();
    }



    /**
     *
     */
    public function createDVA($data)
    {
        return $response = $this->http->post($this->baseUrl . "dedicated_account", $data);
        try {
            $response = $this->http->post($this->baseUrl . "dedicated_account", $data);

            if ($response->failed()) {
                logger("Create DVA call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while trying to Create DVA");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Create DVA connection timeout");
            throw new PaystackServiceException("Could not Create DVA");
        }

        if(!$response->json()['status']){
          logger($response->json()['message']);
          throw new PaystackServiceException($response->json()['message']);
        }
        
        return $response->json();
    }



    public function verifyAccountNumber($accountNumber, $bankCode)
    {
        try {
            logger("Verifing account number");
            $response = $this->http->get($this->baseUrl . "bank/resolve?account_number={$accountNumber}&bank_code=$bankCode");

            if ($response->failed()) {
                logger("Verifing account number call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Verifing account number call failed");
            }
        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Paystack connection timeout");
            throw new PaystackServiceException("Could not validate bank account detail");
        }

        $data = $response->json()["data"];
        return [
            "account_name" => $data["account_name"],
            "account_number" => $data["account_number"],
        ];

    }

    /**
     * Create Create transfer recipent
     */
    public function createTransferRecipient(array $data)
    {
        try {

            $response = $this->http->post($this->baseUrl . "transferrecipient", $data);

            if ($response->failed()) {
                logger("Paystack create transfer recipient", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while creating Paystack create transfer recipient");

            }

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            logger("Paystack connection timeout");
            throw new PaystackServiceException("Could not initiate payment");
        }

        $data = $response->json()["data"];

        return [
            "recipient_code" => $data['recipient_code']
        ];
    }
    /**
     * Create Create transfer recipent
     */
    public function chargeAuthorization(array $data)
    {
        try {

            $response = $this->http->post($this->baseUrl . "transaction/charge_authorization", $data);

            if ($response->failed()) {
                logger("Paystack charge user card", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while charging user card");

            }

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            logger("Paystack connection timeout");
            throw new PaystackServiceException("Could not charge user card");
        }

        return $response->json();
    }


    /**
     *
     */
    public function withdraw(
        string $name,
        string $accountNumber,
        string $bankCode,
        string $currency,
        float $amount,
        string $reference,
        string $reason = "Withdrawal"
    )
    {

        try {
            $recipient = $this->createTransferRecipient([
                "type" => "nuban",
                "name" => $name,
                "account_number" => $accountNumber,
                "bank_code" => $bankCode,
                "currency" => $currency,
            ]);
            $response = $this->http->post($this->baseUrl . "transfer", [
                'source' => "balance",
                'amount' => $amount*100,
                "reference" => $reference,
                'recipient' => $recipient['recipient_code'],
                'reason' => $reason
              ]);

            if ($response->failed()) {
                logger("Transfer transfer call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while trying to make withdrawal");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Transfer connection timeout");
            throw new PaystackServiceException("Could not initiate withdrawal");
        }

        $_data = $response->json()["data"];
        if($_data['status'] == 'otp'){
            return [
                "stage" => "OTP",
                "message" => "Withrawal requires OTP to continue",
                "transfer_code" => $_data['transfer_code'],
                'data' => $_data
            ];
        }
        logger("Transfer transfer call failed", ["body" => $response->json()]);
        return [
            "stage" => "COMPLETED",
            'transactionReference' => $_data['transfer_code'],
            'transaction_status' => 'PENDING',
            'provider' => 'PAYSTACK',
            'data' => $_data
        ];
    }


        /**
     *
     */
    public function initializeTransaction($data)
    {

        try {
            $response = $this->http->post($this->baseUrl . "transaction/initialize", $data);

            if ($response->failed()) {
                logger("Initialize transaction call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while trying to Initialize transaction");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Initialize transaction connection timeout");
            throw new PaystackServiceException("Could not Initialize transaction");
        }
        $_data = $response->json()["data"];

        logger("Initialize Transaction", ["body" => $response->json()]);
        return [
            'authorization_url' => $_data['authorization_url'],
            'access_code' => $_data['access_code'],
            'reference' => $_data['reference'],
            'data' => $_data
        ];
    }


    /**
     *
     */
    public function verifyTransaction($reference)
    {

        try {
            $response = $this->http->get($this->baseUrl . "transaction/verify/{$reference}");

            if ($response->failed()) {
                logger("Initialize transaction call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while trying to Initialize transaction");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Initialize transaction connection timeout");
            throw new PaystackServiceException("Could not Initialize transaction");
        }

        if(!$response->json()['status']){
          logger($response->json()['message']);
          throw new PaystackServiceException($response->json()['message']);
        }

        $_data = $response->json()["data"];

        if($_data['status'] == 'failed'){
          logger($_data['gateway_response']);
          throw new PaystackServiceException($_data['gateway_response']);
        }
        

        logger("Verify Transaction", ["body" => $response->json()]);
        return $response->json();
    }


    /**
     *
     */
    public function getBanks()
    {

        try {
            $response = $this->http->get($this->baseUrl . "bank?country=nigeria&perPage=500");

            if ($response->failed()) {
                logger("Fetch banks call failed", ["body" => $response->body()]);
                throw new PaystackServiceException("Error while trying to Fetch banks");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Fetch banks connection timeout");
            throw new PaystackServiceException("Could not Fetch banks");
        }

        if(!$response->json()['status']){
          logger($response->json()['message']);
          throw new PaystackServiceException($response->json()['message']);
        }

        $_data = $response->json()["data"];
        return $_data;
    }
}
