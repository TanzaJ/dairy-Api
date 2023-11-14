<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Helpers\JWTManager;
use Vanier\Api\Models\AccountsModel;

/**
 * A controller class that handles requests for creating new account and 
 * generating JWTs.
 * 
 * @author frostybee
 */
class AccountsController extends BaseController
{
    private $accounts_model = null;

    public function __construct()
    {
        $this->accounts_model = new AccountsModel();
    }

    /* {
        "first_name": "John",
        "last_name": "Doe",
        "email": "johndoe@gmail.com",
        "password": "JohnDoe123",
        "role": "admin"
    } */
    public function handleCreateAccount(Request $request, Response $response)
    {
        $account_data = $request->getParsedBody();
        if (empty($account_data)) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'No data was provided in the request.'], 400);
        }
        //TODO: before creating the account, verify if there is already an existing one with the provided email.
        // 2) Data was provided, we attempt to create an account for the user.           
        $new_account_id = null;
        if ($this->accounts_model->isAccountExist($account_data["email"]) == false) {
            $new_account_id = $this->accounts_model->createAccount($account_data);
        }
        // 2.1
        if (!$new_account_id) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'Account with that email is already in use.'], 409);
        }
        
        // 3) A new account has been successfully created. 
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"New account has been successfully created."
        );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleGenerateToken(Request $request, Response $response, array $args)
    {
        $account_data = $request->getParsedBody();
        //var_dump($user_data);exit;

        //-- 1) Reject the request if the request body is empty.

        //-- 2) Retrieve and validate the account credentials.

        //-- 3) Is there an account matching the provided email address in the DB?

        //-- 4) If so, verify whether the provided password is valid.

        
        //if (!$db_account) {
            //-- 4.a) If the password is invalid --> prepare and return a response with a message indicating the 
            // reason.            
        //}
        

        //-- 5) Valid account detected => Now, we return an HTTP response containing
        // the newly generated JWT.
        // TODO: add the account role to be included as JWT private claims.
        //-- 5.a): Prepare the private claims: user_id, email, and role.

        // Current time stamp * 60 seconds        
        $expires_in = time() + 60; //! NOTE: Expires in 1 minute.
        //!note: the time() function returns the current timestamp, which is the number of seconds since January 1st, 1970
        //-- 5.b) Create a JWT using the JWTManager's generateJWT() method.
        //$jwt = JWTManager::generateJWT($account_data, $expires_in);
        //--
        // 5.c) Prepare and return a response with a JSON doc containing the jwt.
        return $response;
    }
}
