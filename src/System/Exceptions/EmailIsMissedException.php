<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class EmailIsMissedException extends BaseException
{
    protected $code = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'One of the Emails is missed, check your configs..';
}
