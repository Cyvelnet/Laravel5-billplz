<?php

namespace Cyvelnet\Billplz\Transporters;

use Cyvelnet\Billplz\BillBody;
use Cyvelnet\Billplz\Contracts\BillValidator;
use Cyvelnet\Billplz\Contracts\Transport as TransportContract;
use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Logging\Log;

/**
 * Class Transport
 * @package Cyvelnet\Billplz\Transporters
 */
class Transport extends BaseTransporter implements TransportContract
{


    /**
     * Billplz create bill api url
     */
    const CREATE_BILL_URL = 'https://www.billplz.com/api/v2/bills';

    /**
     * Billplz get bill api url
     */
    const GET_BILL_URL = 'https://www.billplz.com/api/v2/bills';

    /**
     * Billplz delete bill api url
     */
    const DELETE_BILL_URL = 'https://www.billplz.com/api/v2/bills';

    /**
     * Billplz api key
     * @var mixed
     */
    protected $apiKey;

    protected $success;
    /**
     * Guzzle Http Client
     * @var Client
     */
    protected $client;
    /**
     * @var Log
     */
    protected $log;
    /**
     * @var BillValidator
     */
    private $validator;

    /**
     * @param Client $client
     * @param ConfigRepository $config
     * @param Log $log
     * @param BillValidator $validator
     */
    function __construct(Client $client, ConfigRepository $config, Log $log, BillValidator $validator)
    {
        $this->apiKey = $config->get('billplz.api_key');
        $this->client = $client;
        $this->log = $log;
        $this->validator = $validator;
    }


    /**
     * @param $body
     * @return bool|object
     */
    public function sendCreateBillRequest(BillBody $body)
    {
        //unpack create request input

        $requestBody = [
            // mandatory parameters
            'collection_id' => $body->getCollection(),
            'email' => $body->getEmail(),
            'name' => $body->getName(),
            'amount' => $body->getAmount(),
            'callback_url' => $body->getCallback(),

            // optional billplz parameters
            'due_at' => $body->getDueAt(),
            'mobile' => $body->getMobile(),
            'metadata' => $body->getMeta(),
            'deliver' => $body->getDeliver(),
            'redirect_url' => $body->getRedirect()

        ];

        $this->validator->validateCreate($requestBody);

        return $this->sendPost(self::CREATE_BILL_URL, $requestBody);
    }

    public function sendGetBillRequest($billId)
    {
        return $this->sendGet(self::GET_BILL_URL . '/' . $billId);
    }

    public function sendDeleteBillRequest($billId)
    {
        return $this->sendDelete(self::DELETE_BILL_URL . '/' . $billId);
    }

}
