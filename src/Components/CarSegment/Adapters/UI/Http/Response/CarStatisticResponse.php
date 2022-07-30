<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http\Response;

use Components\CarSegment\ReadModel\Model\CarStatisticDto;
use System\Http\Response\JsonApiResponse;

final class CarStatisticResponse extends JsonApiResponse
{
    public static function make(CarStatisticDto $carStatisticDto): CarStatisticResponse
    {
        return new self([
            'id' => $carStatisticDto->carDto->id,
            'brand' => $carStatisticDto->carDto->brand,
            'model' => $carStatisticDto->carDto->model,
            'year' => $carStatisticDto->carDto->year,
            'trip_count' => $carStatisticDto->tripCount,
            'trip_miles' => $carStatisticDto->tripMiles,
        ]);
    }
}
