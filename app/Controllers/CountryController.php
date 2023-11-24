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
use Vanier\Api\Models\CountryModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * A controller class that handles requests concerning countries
 */
class CountryController extends BaseController
{
    private $country_model =null;

    public function __construct() {
        $this->country_model = new CountryModel();
    }

    /**
     * Fetches a list of countries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetCountry(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->country_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        $filters = $request->getQueryParams();
        $country_info = $this->country_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $country_info);
    }

    /**
     * Fetches a list of countries based on the id provided
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetCountryById(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $country_id = $uri_args['country_id'];
        if (!Input::isInt($country_id)) {
            //throw exception
        }
        if($country_id < 0) {
            //throw exception
        }



        $country = $this->country_model->getCountryById($uri_args['country_id']);
        return $this->prepareOkResponse($response,(array) $country);
    }

    /**
     * Creates country entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     */
    public function handleCreateCountry(Request $request, Response $response)
    {
        $countries = $request->getParsedBody();
        if(!isset($countries)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create country/process the request due to missing data.");
        }
        foreach($countries as $key => $country) {
           // $this->validatecountry($country);

            $this->country_model->addCountry($country);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of country entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    /**
     * Updates country entries based on the request body
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleUpdateCountry(Request $request, Response $response, array $uri_args)
    {
        $countries = $request->getParsedBody();
        if(!isset($countries)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update country/process the request due to missing data.");
        }

        foreach($countries as $key => $country) {
            $id = ['country_id' => $country['country_id']];
            unset($country['country_id']);

            $this->validateCountry($country);
            $this->country_model->updateCountry($country, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of country entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    /**
     * Deletes country entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleDeleteCountry(Request $request, Response $response, array $uri_args)
    {
        $countries = $request->getParsedBody(); 
        foreach($countries as $key => $country) {
        $id = ['country_id' => $country['country_id']];
        unset($country['country_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->country_model->deleteCountry($id);
    }

    $response_data = array(
        "code" => HttpCodes::STATUS_ACCEPTED,
        "message"=>"The provided list of country entries have been successfully deleted!"
    );
    return $this->prepareOkResponse(
        $response,
        $response_data,
        HttpCodes::STATUS_ACCEPTED
    );
    }

    /**
     * Validates country entries
     * 
     * @param  array $country the entry to be validated
     */
    public function validateCountry(array $country)
    {
        $rules = array(
            'country_id' => array(
                'required', 'int'
            ),
            'country_name' => array(
            ),
            'region' => array(
            ),
            'population' => array(
                'int'
            ),
            'area_sq_mile' => array(
                'numeric'
            ),
            'population_density_sq_mile' => array(
                'numeric'
            ),
            'gdp_perCapita' => array(
                'numeric'
            )
        );
        $v = new Validator($country);
        $v->mapFieldsRules($rules);
        if ($v->validate()) {
            echo "Data validated";
        } else {
            // Errors
            echo $v->errorsToString();
            echo $v->errorsToJson();
        }
    }
}
