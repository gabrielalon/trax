<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\RemoveCarOwner;

use Components\CarSegment\Application\Ports\CarOwnerAssigner;
use Components\CarSegment\Application\Ports\CarTrips;
use System\Messaging\CommandBus\CommandContract;
use System\Messaging\CommandBus\CommandHandlerContract;

final class RemoveCarOwnerHandler implements CommandHandlerContract
{
    public function __construct(
        private readonly CarTrips $trips,
        private readonly CarOwnerAssigner $assigner,
    ) {
    }

    public function handle(CommandContract $command): void
    {
        assert($command instanceof RemoveCarOwner);

        $model = $this->trips->find($command->userId, $command->carId);

        $this->assigner->unAssignOwner($model->carId, $model->userId);

        $this->trips->remove($model);
    }
}
