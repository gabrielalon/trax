<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http;

use Components\CarSegment\Adapters\UI\Http\Request\CarTripCreateRequest;
use Components\CarSegment\Adapters\UI\Http\Response\CarTripCreatedResponse;
use Components\CarSegment\Application\Commands\CreateCarTrip\CreateCarTrip;
use System\Http\Controller;
use System\Messaging\CommandBus;

class CarTripCreateHttpAdapter extends Controller
{
    public function __construct(
        private readonly CommandBus $bus,
    ) {
    }

    public function __invoke(string $carId, CarTripCreateRequest $request): CarTripCreatedResponse
    {
        $this->bus->dispatch(CreateCarTrip::fromRaw(
            $request->user()->id,
            $carId,
            $request->miles(),
            $request->validatedDate(),
        ));

        return new CarTripCreatedResponse();
    }
}
