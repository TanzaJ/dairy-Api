<?php

namespace Vanier\Api\Controllers;

use Vanier\Api\Models\NutritionalValueModel;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Slim\Exception\HttpBadRequestException;

class NutritionalValueController extends BaseController
{
    private $nv_model =null;

    public function __construct() {
        $this->nv_model = new NutritionalValueModel();
    }

    public function handleGetNV(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->nv_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        $filters = $request->getQueryParams();
        $nv_info = $this->nv_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $nv_info);
    }

}
