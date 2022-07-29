<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\CarId;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class CarIdTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $id = new CarId($value = self::id());

        self::assertEquals($value, $id->value());
    }

    /**
     * @test
     */
    public function shouldFailGettingValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new CarId('wrong-value');
    }
}
