<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\TripMiles;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class TripMilesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $brand = new TripMiles($value = 12.2);

        self::assertEquals($value, $brand->value());
    }

    /**
     * @test
     */
    public function shouldFailGettingValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new TripMiles(-12);
    }
}
