<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http;

use Components\CarSegment\Adapters\UI\Http\Response\CarListResponse;
use Components\CarSegment\ReadModel\Ports\GetCars;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use System\Http\Controller;

final class CarListHttpAdapter extends Controller
{
    public function __construct(
        private readonly GetCars $getCars,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $cars = $this->getCars->getCars($request->user()->id);

        return CarListResponse::make($cars);
    }
}
