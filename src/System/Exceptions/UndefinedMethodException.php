<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class UndefinedMethodException extends BaseException
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'Undefined HTTP Verb!';
}
