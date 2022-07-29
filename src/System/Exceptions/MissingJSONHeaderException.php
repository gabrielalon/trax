<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class MissingJSONHeaderException extends BaseException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Your request must contain [Accept = application/json].';
}
