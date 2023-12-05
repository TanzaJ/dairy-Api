<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AboutController extends BaseController
{
    public function handleAboutApi(Request $request, Response $response, array $uri_args)
    {   
        $resources = array(
            'root',
            'brand',
            'milk' => ['GET /milk', 'POST /milk', 'PUT /milk', 'DELETE /milk'],
            'butter' => ['GET /milk', 'POST /milk', 'PUT /milk', 'DELETE /milk'],
            'cheese' => ['GET /milk', 'POST /milk', 'PUT /milk', 'DELETE /milk'],
            'ice_cream' => ['GET /milk', 'POST /milk', 'PUT /milk', 'DELETE /milk'],
            'country' => ['GET /country'],
            'nutritional value' => ['GET /nutritional_value'],
            'projected milk production' => ['GET /projected_milk_production']
        );

        $data = array(
            'about' => 
            'Welcome to the Dairy API! This is a web service that fetches
             and update a database of dairy products from across the globe.
             We can receive information about a product\'s production, brand and
             even the country of origin.',
            'resources' => implode(",", $resources)
        );                
        return $this->prepareOkResponse($response, $data);
    }
}
