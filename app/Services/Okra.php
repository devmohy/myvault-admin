<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;

use App\Exceptions\OkraServiceException;

class Okra { 

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
        $this->baseUrl = config("services.okra.baseUrl");
        $this->setToken();
        $this->http = $http::withToken($this->token);
    }

    private function setToken()
    {
        $this->token  = env("OKRA_TOKEN");
    }


 
 

    /**
     * Get FULL BVN KYC that includes bvn_photo
     */
    public function getKYC(string $bvn): array
    {
        try{
            $response = $this->http->post($this->baseUrl . 'products/kyc/bvn-verify', [
                'bvn' => $bvn
            ]);

        }catch(\Illuminate\Http\Client\ConnectionException $e){
            logger("Okra connection timeout");
            throw new OkraServiceException("Could not validate BVN");
        }


        if($response->failed()){ 
            logger("Error occured when fetching KYC with BVN from Okra", ["data" => $response->json()]);
            throw new OkraServiceException("Could not validate BVN"); 
        } 

        $photo_public_url = null;
        if($response->json()["data"]["photo_id"] && count($response->json()["data"]["photo_id"]) > 0  )
        {
            $photo_public_url = $response->json()["data"]["photo_id"][0]["url"]; 
        }

        return [
            'fullname' => $response->json()["data"]["fullname"],
            'last_name' => $response->json()["data"]["lastname"],
            'middle_name' => $response->json()["data"]["middlename"],
            'first_name' => $response->json()["data"]["firstname"],
            'gender' => strtoupper($response->json()["data"]["gender"]),
            "bvn_phone_number" => $response->json()["data"]["phone"][0],
            'city' => $response->json()["data"]["lga_of_residence"] ?? null,
            'state' => $response->json()["data"]["state_of_residence"] ?? null,
            'country' => $response->json()["data"]["nationality"] ?? null,
            'nin' => $response->json()["data"]["nin"] ?? null,
            'date_of_birth' => Carbon::parse($response->json()["data"]["dob"])->format('Y-m-d') ,
            "bvn" => $response->json()["data"]["bvn"],
            "avatar" => $photo_public_url
        ];
    }

    public function getBankDetails(string $nuban, string $bank_code): array
    {

        try{

            $response = $this->http->timeout(60)
            ->post($this->baseUrl . 'products/kyc/nuban-verify', [
                'nuban' => $nuban,
                'bank'=> $bank_code,
            ]);

        }catch(\Illuminate\Http\Client\ConnectionException $e){
            logger("Okra connection timeout");
            throw new OkraServiceException("Could not validate Bank Details");
        }

        if($response->failed()){ 
            logger("Error occured when fetching KYC with Bank Details from Okra", ["data" => $response->json()]);
            throw new OkraServiceException("Could not validate Bank Account Information"); 
        } 

        $photo_public_url = null;
        if($response->json()["data"]["identity"]["photo_id"] && count($response->json()["data"]["identity"]["photo_id"]) > 0  )
        {
            $photo_public_url = $response->json()["data"]["identity"]["photo_id"][0]["url"];
        }
        
        return [
            'fullname' => $response->json()["data"]["identity"]["fullname"],
            'last_name' => $response->json()["data"]["identity"]["lastname"],
            'middle_name' => $response->json()["data"]["identity"]["middlename"],
            'first_name' => $response->json()["data"]["identity"]["firstname"],
            'gender' => strtoupper($response->json()["data"]["identity"]["gender"]),
            "bvn_phone_number" => $response->json()["data"]["identity"]["phone"][0],
            'city' => $response->json()["data"]["identity"]["lga_of_residence"],
            'state' => $response->json()["data"]["identity"]["state_of_residence"],
            'country' => $response->json()["data"]["identity"]["nationality"],
            'nin' => $response->json()["data"]["identity"]["nin"],
            'date_of_birth' => Carbon::parse($response->json()["data"]["identity"]["dob"])->format('Y-m-d') ,
            "bvn" => $response->json()["data"]["identity"]["bvn"],
            "avatar" => $photo_public_url
        ];
    }


    public function verifyAccountNumber($accountNumber, $bank): array
    {
        try{
            $bank_code = $bank->okra_bank_code;
            $response = $this->http->post($this->baseUrl . 'products/kyc/nuban-verify', [
                'account_number' => $accountNumber,
                'bank' => $bank_code
            ]);

        }catch(\Illuminate\Http\Client\ConnectionException $e){
            logger("Okra connection timeout");
            throw new OkraServiceException("Could not validate Account details");
        }

        if($response->failed()){ 
            logger("Error occured when fetching Account details from Okra", ["data" => $response->json()]);
            throw new OkraServiceException("Could not validate Account details"); 
        } 

        return [
             'account_name' => $response->json()["data"]["identity"]["fullname"],
             "account_number" => $accountNumber
        ];
    }

}