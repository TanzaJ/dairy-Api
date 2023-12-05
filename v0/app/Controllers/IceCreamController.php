<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\IceCreamModel;

class IceCreamController extends BaseController
{
    private $ice_cream_model =null;

    public function __construct() {
        $this->ice_cream_model = new IceCreamModel();
    }

    public function handleGetIceCream(Request $request, Response $response, array $uri_args)
    {
        $milk_id = $uri_args['milk_id'];
        if (!Input::isInt($milk_id)) {
            throw new HttpNotFoundException($request, "Invalid milk id was provided!");
        }
        $filters = $request->getQueryParams();
        $ice_cream_info = $this->ice_cream_model->getAll($uri_args['milk_id'], $filters);
        return $this->prepareOkResponse($response,(array) $ice_cream_info);
    }

}
