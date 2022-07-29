<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\CreateCarWithOwner;

use Components\CarSegment\Application\Ports\CarOwnerAssigner;
use Components\CarSegment\Application\Ports\Cars;
use System\Messaging\CommandBus\CommandContract;
use System\Messaging\CommandBus\CommandHandlerContract;

final class CreateCarWithOwnerHandler implements CommandHandlerContract
{
    public function __construct(
        private readonly Cars $cars,
        private readonly CarOwnerAssigner $assigner,
    ) {
    }

    public function handle(CommandContract $command): void
    {
        assert($command instanceof CreateCarWithOwner);

        $carId = $this->cars->create($command->brand, $command->model, $command->year);

        $this->assigner->assignOwner($carId, $command->userId);
    }
}
