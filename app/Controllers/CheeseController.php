<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CheeseModel;

class CheeseController extends BaseController
{
    private $cheese_model =null;

    public function __construct() {
        $this->cheese_model = new CheeseModel();
    }

    public function handleGetCheese(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->cheese_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }

        $filters = $request->getQueryParams();
        $cheese_info = $this->cheese_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $cheese_info);
    }

}
