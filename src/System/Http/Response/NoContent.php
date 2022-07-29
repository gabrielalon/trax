<?php declare(strict_types=1);

namespace System\Http\Response;

use Symfony\Component\HttpFoundation\Response;

class NoContent extends Response
{
    public static function make(): self
    {
        return new self('', self::HTTP_NO_CONTENT);
    }
}
