<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class NotAuthorizedResourceException extends BaseException
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'You are not authorized to request this resource.';
}
