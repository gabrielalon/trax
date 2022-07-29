<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http\Response;

use Illuminate\Http\JsonResponse;

final class CarCreatedResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(null, self::HTTP_CREATED);
    }
}
