<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http;

use Components\CarSegment\Adapters\UI\Http\Response\CarTripListResponse;
use Components\CarSegment\ReadModel\Ports\GetCarTrips;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CarTripListHttpAdapter
{
    public function __construct(
        private readonly GetCarTrips $carTrips,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $carTrips = $this->carTrips->getCarTrips($request->user()->id);

        return CarTripListResponse::make($carTrips);
    }
}
