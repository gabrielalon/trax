<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class WrongEndpointFormatException extends BaseException
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'tests ($this->endpoint) property must be formatted as "verb@url".';
}
