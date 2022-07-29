<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class IncorrectIdException extends BaseException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'ID input is incorrect.';
}
