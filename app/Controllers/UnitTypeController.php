<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\UnitTypeModel;
use Slim\Exception\HttpBadRequestException;

class UnitTypeController extends BaseController
{
    private $unit_type_model =null;

    public function __construct() {
        $this->unit_type_model = new UnitTypeModel();
    }

    public function handleGetUnitType(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->unit_type_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }

        $filters = $request->getQueryParams();
        $unit_type_info = $this->unit_type_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $unit_type_info);
    }

}
