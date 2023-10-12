<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CountryModel;

class CountryController extends BaseController
{
    private $country_model =null;

    public function __construct() {
        $this->country_model = new CountryModel();
    }

    public function handleGetCountry(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $country_info = $this->country_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $country_info);
    }

}
