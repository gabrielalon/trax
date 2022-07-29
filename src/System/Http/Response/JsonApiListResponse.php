<?php declare(strict_types=1);

namespace System\Http\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class JsonApiListResponse extends JsonResponse
{
    public function __construct(array $list, int $status = Response::HTTP_OK)
    {
        parent::__construct(['data' => $list], $status);
    }
}
