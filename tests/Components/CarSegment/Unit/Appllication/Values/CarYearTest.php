<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\CarYear;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class CarYearTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $brand = new CarYear($value = (int) date('Y'));

        self::assertEquals($value, $brand->value());
    }

    /**
     * @test
     */
    public function shouldFailGettingValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new CarYear(1800);
    }
}
