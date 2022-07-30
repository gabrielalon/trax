<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\CreateCarWithOwner;

use System\Messaging\CommandBus\CommandContract;

final class CreateCarWithOwner implements CommandContract
{
    public function __construct(
        public readonly int $userId,
        public readonly string $brand,
        public readonly string $model,
        public readonly int $year
    ) {
    }
}
