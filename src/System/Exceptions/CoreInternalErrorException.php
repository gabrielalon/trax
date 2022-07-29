<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class CoreInternalErrorException extends BaseException
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'Something went wrong!';
}
