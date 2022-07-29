<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\CreateCarTrip;

use Components\CarSegment\Application\Ports\CarTrips;
use System\Messaging\CommandBus\CommandContract;
use System\Messaging\CommandBus\CommandHandlerContract;

final class CreateCarTripHandler implements CommandHandlerContract
{
    public function __construct(
        private readonly CarTrips $trips,
    ) {
    }

    public function handle(CommandContract $command): void
    {
        assert($command instanceof CreateCarTrip);

        $this->trips->create($command->userId, $command->carId, $command->miles, $command->date);
    }
}
