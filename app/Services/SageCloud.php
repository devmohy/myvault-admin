<?php

namespace App\Services;

use App\Models\APIToken;
use Illuminate\Support\Facades\Http;
use App\Exceptions\SageCloudException;

class SageCloud
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
    $this->baseUrl = config("services.sagecloud.baseUrl");
    $this->setToken();
    $this->http = $http::withToken($this->token);
  }

  private function setToken()
  {
    $cred = APIToken::where('provider', 'SAGECLOUD')->first();
    try {
      $token = Http::post("{$this->baseUrl}/merchant/authorization", [
        "email" => $cred->username,
        "password" => $cred->password
      ])->json();
      if(isset($token['data'])){
        $this->token = $token['data']['token']["access_token"];
      } else {
        logger($token);
        throw new SageCloudException("Something went wrong, try again later");
      }
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      throw new SageCloudException("Could not set token");
    }
  }


  /**
   *  Fetching electricity service providers
   */
  public function getElectricityServiceProviders()
  {

    try {

      $response = $this->http->get("{$this->baseUrl}/electricity/fetch-billers");
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not electricity billers");
    }

    if ($response->failed()) {
      logger("Error occured when fetching electricity service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get electricity service providerr");
    }

    return $response->json();
  }

  /**
   *  Validate meter
   */
  public function validateMeter($type, $account_number)
  {

    try {

      $response = $this->http->post("{$this->baseUrl}/electricity/validate-customer",[
        "type" => $type,
         "account_number" => $account_number
      ]);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not validate Meter at this time");
    }

    if ($response->failed()) {
      logger("Error occured when fetching electricity service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get electricity service providerr");
    }

    return $response->json();
  }

  /**
   *  Validate meter
   */
  public function purchaseElectricity(array $data)
  {

    try {

      $response = $this->http->post("{$this->baseUrl}/electricity/purchase",$data);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not validate Meter at this time");
    }

    if ($response->failed()) {
      logger("Error occured when fetching electricity service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get electricity service providerr");
    }

    return $response->json();
  }

  /**
   *  Validate meter
   */
  public function buyAirtime(array $data)
  {

    try {

      $response = $this->http->post("{$this->baseUrl}/airtime",$data);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not validate Meter at this time");
    }

    if ($response->failed()) {
      logger("Error occured when fetching electricity service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get electricity service providerr");
    }

    return $response->json();
  }


    /**
   *  Fetching electricity service providers
   */
  public function dataLookup($provider)
  {

    try {

      $response = $this->http->get("{$this->baseUrl}/internet/data/lookup?provider=$provider");
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not fetch internet data packages");
    }

    if ($response->failed()) {
      logger("Error occured when fetching internet data packages from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not fetch internet data packages");
    }

    return $response->json();
  }

  /**
   *  Buy Internet Data
   */
  public function buyData(array $data)
  {

    try {

      $response = $this->http->post("{$this->baseUrl}/internet/data",$data);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not buy data at this time");
    }

    if ($response->failed()) {
      logger("Error occured when buying data from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not buy data at this time");
    }

    return $response->json();
  }

  /**
   *  Fetching cable tv service providers
   */
  public function getTvPackages($type)
  {

    try {

      $response = $this->http->get("{$this->baseUrl}/cable-tv/fetch-billers?type=$type");
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not tv cable providers");
    }

    if ($response->failed()) {
      logger("Error occured when fetching tv cable service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get tv cable service providerr");
    }

    return $response->json();
  }

  /**
   *  Validate cable tv customer
   */
  public function validateTvCustomer($biller_id, $smartCardNo)
  {

    try {

      $response = $this->http->post("{$this->baseUrl}/cable-tv/validate-customer",[
        'biller_id' => $biller_id,
        'smartCardNo' => $smartCardNo
      ]);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not validate Meter at this time");
    }

    if ($response->failed()) {
      logger("Error occured when fetching electricity service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get electricity service providerr");
    }

    return $response->json();
  }

  /**
   *  Fetching cable tv service providers
   */
  public function getTvServiceProviders()
  {

    try {

      $response = $this->http->get("{$this->baseUrl}/cable-tv/fetch-providers");
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not tv cable providers");
    }

    if ($response->failed()) {
      logger("Error occured when fetching tv cable service providers from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not get tv cable service providerr");
    }

    return $response->json();
  }

  /**
   *  Buy Tv Package
   */
  public function buyTvPackage(array $data)
  {

    try {

      $response = $this->http->post("{$this->baseUrl}/cable-tv/purchase",$data);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      logger("Sage connection timeout");
      throw new SageCloudException("Could not buy data at this time");
    }

    if ($response->failed()) {
      logger("Error occured when buying data from SageCloud", ["data" => $response->json()]);
      throw new SageCloudException("Could not buy data at this time");
    }

    return $response->json();
  }
}
