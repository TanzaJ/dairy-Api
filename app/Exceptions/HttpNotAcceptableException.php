<?php

namespace Vanier\Api\Exceptions;
use Slim\Exception\HttpSpecializedException;
class HttpNotAcceptableException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 406;

    /**
     * @var string
     */
    protected $message = 'Not acceptable.';

    protected string $title = '406 Not Acceptable';
    protected string $description = 'the server cannot produce a response matching the list of acceptable values defined in the requests proactive content negotiation headers';
}
