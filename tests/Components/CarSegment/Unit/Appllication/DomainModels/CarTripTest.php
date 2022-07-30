<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\DomainModels;

use Components\CarSegment\Application\DomainModels\CarTrip;
use Tests\TestCase;

final class CarTripTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateModel(): void
    {
        CarTrip::create(12, self::id(), 12.32, $this->faker->date());

        $this->expectNotToPerformAssertions();
    }
}
