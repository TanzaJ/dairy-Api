<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AboutController extends BaseController
{
    public function handleAboutApi(Request $request, Response $response, array $uri_args)
    {
        $routes = [
            'GET /' => 'Welcome, this is a Web service that provides data regarding dairy products',
            'GET /milk' => 'Retrieves information about milk products.',
            'POST /milk' => 'Creates a new entry for milk products.',
            'PUT /milk' => 'Updates information about existing milk products.',
            'DELETE /milk/{milk_id}' => 'Deletes a specific milk product based on the provided `milk_id`.',
            'GET /cheese' => 'Retrieves information about cheese products.',
            'POST /cheese' => 'Creates a new entry for cheese products.',
            'PUT /cheese' => 'Updates information about existing cheese products.',
            'DELETE /cheese' => 'Deletes a specific cheese product.',
            'GET /ice_cream' => 'Retrieves information about ice cream products.',
            'POST /ice_cream' => 'Creates a new entry for ice cream products.',
            'PUT /ice_cream' => 'Updates information about existing ice cream products.',
            'DELETE /ice_cream/{ice_cream_id}' => 'Deletes a specific ice cream product based on the provided `ice_cream_id`.',
            'GET /butter' => 'Retrieves information about butter products.',
            'POST /butter' => 'Creates a new entry for butter products.',
            'PUT /butter/{butter_id}' => 'Updates information about existing butter products.',
            'DELETE /butter/{butter_id}' => 'Deletes a specific butter product based on the provided `butter_id`.',
            'GET /brand' => 'Retrieves information about brands.',
            'POST /brand' => 'Creates a new entry for brands.',
            'PUT /brand/{brand_id}' => 'Updates information about an existing brand based on the provided `brand_id`.',
            'DELETE /brand/{brand_id}' => 'Deletes a specific brand based on the provided `brand_id`.',
            'GET /country' => 'Retrieves information about countries.',
            'GET /projected_milk_production' => 'Retrieves information about projected milk production.',
            'GET /nutritional_value' => 'Retrieves information about nutritional values.',
            'GET /unit_type' => 'Retrieves information about unit types.',
        ];

        $data = [
            'about' => 'Welcome, this is a Web service that provides data regarding dairy products',
            'routes' => $routes,
        ];

        return $this->prepareOkResponse($response, $data);
    }
}
