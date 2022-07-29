<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class DeleteResourceFailedException extends BaseException
{
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    protected $message = 'Failed to delete Resource.';
}
