<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\ProjMilkModel;

class ProjMilkController extends BaseController
{
    private $proj_milk_model =null;

    public function __construct() {
        $this->proj_milk_model = new ProjMilkModel();
    }

    public function handleGetProjMilk(Request $request, Response $response, array $uri_args)
    {
        $milk_id = $uri_args['milk_id'];
        if (!Input::isInt($milk_id)) {
            throw new HttpNotFoundException($request, "Invalid milk id was provided!");
        }
        $filters = $request->getQueryParams();
        $proj_milk_info = $this->proj_milk_model->getAll($uri_args['milk_id'], $filters);
        return $this->prepareOkResponse($response,(array) $proj_milk_info);
    }


}
