<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\BrandModel;

class BrandController extends BaseController
{
    private $brand_model =null;

    public function __construct() {
        $this->brand_model = new BrandModel();
    }

    public function handleGetBrand(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $brand_info = $this->brand_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $brand_info);
    }

}
