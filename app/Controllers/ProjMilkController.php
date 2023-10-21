<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ProjMilkModel;
use Slim\Exception\HttpBadRequestException;

class ProjMilkController extends BaseController
{
    private $proj_milk_model =null;

    public function __construct() {
        $this->proj_milk_model = new ProjMilkModel();
    }

    public function handleGetProjMilk(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->proj_milk_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        
        $filters = $request->getQueryParams();
        $proj_milk_info = $this->proj_milk_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $proj_milk_info);
    }


}
