<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class NotImplementedException extends BaseException
{
    protected $code = Response::HTTP_NOT_IMPLEMENTED;
    protected $message = 'This method is not yet implemented.';
}
