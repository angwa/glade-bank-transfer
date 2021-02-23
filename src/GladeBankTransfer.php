<?php
namespace GladeApi\GladeBankTransfer;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;


class GladeBankTransfer
{
    /**
     * Merchant Key from your Glade account Dashboard
     * @var string
     */
    protected $merchantKey;

    /**
     * Merchant Id from your Glade account Dashboard
     * @var string
     */

    protected $merchantId;

    /**
     * Glade API Url 
     * @var string
     */
     protected $baseUrl;

    /**
     * Instance of Client
     * @var Client
     */
    protected $client;

    /**
     *  Response from requests made
     * @var mixed
     */
    protected $response;
    /**
     * Default constructor, holds
     * MerchantKey
     * MerchantId
     * Url
     * RequestOptions
     */

    public function __construct()
    {
        $this->setMerchantKey();
        $this->setMerchantId();
        $this->setUrl();
        $this->setRequestOptions();
    }

    /**
     * Setting options for making the Client request
     */
    private function setRequestOptions()
    {
        $mid = $this->merchantId;
        $key = $this->merchantKey;
        $header = [
                    'mid' => $mid,
                    'key' => $key,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json',
                ];
                
        $this->client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'headers' => $header
            ]
        );
    }
    /**
     * Get payment URL from Config
     */

    public function setUrl()
    {
        $this->baseUrl =  Config::get('glade.paymentUrl');
    }


    /**
     * Get merchant key from glade config file
     */
    public function setMerchantKey()
    {
        $this->merchantKey = Config::get('glade.merchantKey');
    }

    /**
     * Get merchant key from glade config file
     */
    public function setMerchantId()
    {
        $this->merchantId = Config::get('glade.merchantId');
    }
    
    /**
     * @param string $appendUrl
     * @param array $body
     * @return setApiResponse
     */
    private function setApiResponse($appendUrl, $body = [])
    { 
        
        $this->response  = $this->client->request('put', 
            $this->baseUrl .'/'.$appendUrl, ["body" => json_encode($body)]            
        );       
        return $this;  
        
    }
    /**
     * make payment
     * @param string $amount
     * @param string $business_name
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @return setApiResponse
     */
    public function makePayment($amount, $business_name=null, $firstname=null,$lastname=null,$email=null)
    {

        $body = [
            "action" => "charge",
            "paymentType" => "bank_transfer",
            "amount" => $amount,
            "country" => "NG",
            "currency" => "NGN",
            "business_name" => $business_name,
            "user"=>[
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "email"=>$email,
                "fingerprint"=>"cccvxbxbxb",
            ]

        ];
            
       return  $this->setApiResponse("payment", $body)->getResponse();
    }
    /**
     * verify payment transaction
     * @param string $ref
     * @return setApiResponse
     */
    public function verifyTransaction($ref)
    {
        $data = [
            "action" => "verify",
            "paymentType" => "bank_transfer",
            "txnRef" => $ref
        ];

        return $this->setApiResponse('payment',$data)->getResponse();
    }
    /**
     * Get Response
     * @return response json_decode
     */

    private function getResponse()
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

}