<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\UnitTypeModel;

class UnitTypeController extends BaseController
{
    private $unit_type_model =null;

    public function __construct() {
        $this->unit_type_model = new UnitTypeModel();
    }

    public function handleGetUnitType(Request $request, Response $response, array $uri_args)
    {
        $milk_id = $uri_args['milk_id'];
        if (!Input::isInt($milk_id)) {
            throw new HttpNotFoundException($request, "Invalid milk id was provided!");
        }
        $pmp_id = $uri_args['pmp_id'];
        if (!Input::isInt($pmp_id)) {
            throw new HttpNotFoundException($request, "Invalid pmp id was provided!");
        }
        $filters = $request->getQueryParams();
        $unit_type_info = $this->unit_type_model->getAll($uri_args['milk_id'], $uri_args['pmp_id'], $filters);
        return $this->prepareOkResponse($response,(array) $unit_type_info);
    }

}
