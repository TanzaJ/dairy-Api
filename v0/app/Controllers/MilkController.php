<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\MilkModel;

class MilkController extends BaseController
{
    private $milk_model =null;

    public function __construct() {
        $this->milk_model = new MilkModel();
    }

    public function handleGetMilk(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        //-- Step 1) Pull the list of milk from the database
        $milk = $this->milk_model->getAll($filters);
        //--Step 2) Prepare the HTTP request
        return $this->prepareOkResponse($response,(array) $milk);
    }
}
