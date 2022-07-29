<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\TripDate;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class TripDateTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $date = new TripDate('2022-07-12T22:00:00.000Z');

        self::assertNotNull($date->value());
    }

    /**
     * @test
     */
    public function shouldFailGettingValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new TripDate('wrong-value');
    }
}
