<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class UnsupportedFractalIncludeException extends BaseException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Requested a invalid Include Parameter.';
}
