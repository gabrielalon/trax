<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class MissingTestEndpointException extends BaseException
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'Property ($this->endpoint) is missed in your test.';
}
