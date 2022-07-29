<?php

namespace System\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class AuthenticationException extends BaseException
{
    protected $code = Response::HTTP_UNAUTHORIZED;
    protected $message = 'An Exception occurred while trying to authenticate the User.';
}
