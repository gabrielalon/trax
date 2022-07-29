<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http\Response;

use Components\CarSegment\ReadModel\Model\CarDto;
use System\Http\Response\JsonApiListResponse;

final class CarListResponse extends JsonApiListResponse
{
    public static function make(array $cars): CarListResponse
    {
        return new self(array_map(static fn (CarDto $car) => [
            'id' => $car->id,
            'make' => $car->brand,
            'model' => $car->model,
            'year' => $car->year,
        ], $cars));
    }
}
