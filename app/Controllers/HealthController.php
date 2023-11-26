<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\BrandModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * A controller class that handles requests concerning brands
 */
class HealthController extends BaseController
{

    public function __construct() {
    }

    /**
     * Fetches a list of brands
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetHealth(Request $request, Response $response, array $uri_args)
    {
        $params = $request->getQueryParams();
        $height = $params['height'] ?? null;
        $weight = $params['weight'] ?? null;
        $unit = $params['unit'] ?? 'metric';
        // var_dump($params);

        if (!is_numeric($height) || !is_numeric($weight)) {
            throw new HttpBadRequestException($request, 'Invalid height or weight');
        }

        if ($unit === 'imperial') {
            $weight = $weight * 0.453592; // pounds to kilograms
            $height = $height * 2.54; // inches to centimeters
        }

        $bmi = $weight / (($height / 100) ** 2);
        $cheeseForMe = $this->shouldEatCheese($bmi); // cheese to me

        $data = ['bmi' => $bmi, 'cheeseForMe' => $cheeseForMe];

        return $this->prepareOkResponse($response, $data);

    }

    /**
     * Checks if the user should eat cheese based off BMI
     * 
     * @param float $bmi the bmi being used to calculate the response
     */

    function shouldEatCheese($bmi)
    {
        if ($bmi < 18.5) {
            return 'EAT MORE CHEESE';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return 'Cheese is your best friend :)';
        } elseif ($bmi >= 25 && $bmi < 30) {
            return 'Probably should start limiting your intake';
        } else {
            return 'DO. NOT. EAT. CHEESE';
        }
    }

}
