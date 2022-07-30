<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http;

use Components\CarSegment\Adapters\UI\Http\Request\CarCreateRequest;
use Components\CarSegment\Adapters\UI\Http\Response\CarCreatedResponse;
use Components\CarSegment\Application\Commands\CreateCarWithOwner\CreateCarWithOwner;
use System\Messaging\CommandBus;

final class CarCreateHttpAdapter
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    public function __invoke(CarCreateRequest $request): CarCreatedResponse
    {
        $this->commandBus->dispatch(new CreateCarWithOwner(
            $request->user()->id,
            $request->brand(),
            $request->model(),
            $request->year(),
        ));

        return new CarCreatedResponse();
    }
}
