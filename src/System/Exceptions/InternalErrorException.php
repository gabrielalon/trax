<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class InternalErrorException extends BaseException
{
    protected $code = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'Something went wrong!';
}
