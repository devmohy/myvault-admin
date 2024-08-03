<?php

namespace App\Services;

use App\Models\User;
use App\Models\APIToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Exceptions\PaystackServiceException;
use App\Exceptions\ProvidousServiceException;

class Providus
{
    protected $http;
    protected $clientId;
    protected $authSignature;
    protected $baseUrl;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(Http $http)
    {
        $this->baseUrl = config("services.providus.baseUrl");
        $this->setCredentials();
        $this->http = $http::withHeaders([
            'X-Auth-Signature' => $this->authSignature,
            'Client-Id' => $this->clientId
        ]);

    }

    private function setCredentials()
    {
        $apiToken = APIToken::where('provider', 'PROVIDUS')->first();
        $this->clientId  = $apiToken->username;
        $this->authSignature  = $apiToken->token;
    }



    /**
     *
     */
    public function updateAccountName($data)
    {

        $url = "https://vps.providusbank.com/vps/api/PiPUpdateAccountName";
        try {
            return $response = $this->http->post($url, $data);

            if ($response->failed()) {
                logger("Create customer call failed", ["body" => $response->body()]);
                throw new ProvidousServiceException("Error while trying to Create customer");
            }

        } catch (\Illuminate\Http\Client\ConnectionException$e) {
            logger("Create customer connection timeout");
            throw new ProvidousServiceException("Could not create customer");
        }

        if(!$response->json()['status']) {
            logger($response->json()['message']);
            throw new ProvidousServiceException($response->json()['message']);
        }

        logger("Create customer successful", ["body" => $response->json()]);
        return $response->json();
    }

}