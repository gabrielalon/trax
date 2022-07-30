<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http\Response;

use Components\CarSegment\ReadModel\Model\CarTripDto;
use System\Http\Response\JsonApiListResponse;

final class CarTripListResponse extends JsonApiListResponse
{
    public static function make(array $carTrips): CarTripListResponse
    {
        return new self(array_map(static fn(CarTripDto $carTrip) => [
            'id'  => $carTrip->id,
            'date' => $carTrip->date->format('m/d/Y'),
            'miles' => $carTrip->miles,
            'total' => $carTrip->total,
            'car' => [
                'id' => $carTrip->carDto->id,
                'brand' => $carTrip->carDto->brand,
                'model' => $carTrip->carDto->model,
                'year' => $carTrip->carDto->year,
            ],
        ], $carTrips));
    }
}
