<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class CreateResourceFailedException extends BaseException
{
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    protected $message = 'Failed to create Resource.';
}
