<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Utils\Assemblers;

final class CarTripCreateRequestAssembler
{
    public function __construct(
        private mixed $date,
        private mixed $miles,
    ) {
    }

    public static function new(): self
    {
        return new self('2022-07-12T22:00:00.000Z', 12.32);
    }

    public function withDate(mixed $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function withMiles(mixed $miles): self
    {
        $this->miles = $miles;

        return $this;
    }

    public function assemble(): array
    {
        return array_filter([
            'date' => $this->date,
            'miles' => $this->miles,
        ]);
    }
}
