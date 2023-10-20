<?php

namespace Vanier\Api\Exceptions;

use Slim\Exception\HttpSpecializedException;
class HttpInvalidInputException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 422;

    /**
     * @var string
     */
    protected $message = 'Not found.';

    protected string $title = '422 Not Found';
    protected string $description = 'The requested resource could not be found. Please verify the URI and try again.';

}
