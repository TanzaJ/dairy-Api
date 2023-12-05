<?php

namespace Vanier\Api\Helpers;

use GuzzleHttp\Client;

class WebServiceInvoker
{
    private array $options = [];

    public function __construct(array $request_options = [])
    {
        $this->options = $request_options;
    }

    //Read only function: it pulls data from a remote Web service
    public function invokeUri($resourceUri): mixed
    {
        //Step 1) Send the request
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", $resourceUri);
        //Step 2) Process the response

        if ($response->getStatusCode() === 200) {
            //--Valid response
            $response_payload = $response->getBody()->getContents();
            if (!empty($response_payload)) {
                $data = json_decode($response_payload);
                return $data;
            }
        }
        return null;
    }
}
