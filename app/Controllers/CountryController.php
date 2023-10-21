<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpBadRequestException;
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
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->country_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        $filters = $request->getQueryParams();
        $country_info = $this->country_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $country_info);
    }

}
