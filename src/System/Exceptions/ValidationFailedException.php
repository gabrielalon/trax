<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class ValidationFailedException extends BaseException
{
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
    protected $message = 'Invalid Input.';
}
