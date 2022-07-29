<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http;

use Components\CarSegment\Adapters\UI\Http\Response\CarStatisticResponse;
use Components\CarSegment\ReadModel\Ports\GetCarStatistic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use System\Http\Controller;

final class CarGetHttpAdapter extends Controller
{
    public function __construct(
        private readonly GetCarStatistic $carStatistic,
    ) {
    }

    public function __invoke(string $carId, Request $request): JsonResponse
    {
        $car = $this->carStatistic->getCarStatistic($request->user()->id, $carId);

        return CarStatisticResponse::make($car);
    }
}
