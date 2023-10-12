<?php

namespace Vanier\Api\Controllers;

use Vanier\Api\Models\NutritionalValueModel;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;

class NutritionalValueController extends BaseController
{
    private $nv_model =null;

    public function __construct() {
        $this->nv_model = new NutritionalValueModel();
    }

    public function handleGetNV(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $nv_info = $this->nv_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $nv_info);
    }

}
