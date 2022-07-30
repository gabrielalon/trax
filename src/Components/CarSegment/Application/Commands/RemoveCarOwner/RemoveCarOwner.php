<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\RemoveCarOwner;

use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\UserId;
use System\Messaging\CommandBus\CommandContract;

final class RemoveCarOwner implements CommandContract
{
    public function __construct(
        public readonly int $userId,
        public readonly string $carId,
    ) {
    }
}
