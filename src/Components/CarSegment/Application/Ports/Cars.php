<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Ports;

use Components\CarSegment\Application\DomainModels\Car;
use Components\CarSegment\Application\Values\CarId;

interface Cars
{
    public function save(Car $car): CarId;
}
