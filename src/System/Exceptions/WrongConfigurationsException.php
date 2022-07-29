<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class WrongConfigurationsException extends BaseException
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'Ops! Some Containers configurations are incorrect!';
}
