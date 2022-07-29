<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class GeneratorErrorException extends BaseException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Generator Error.';
}
