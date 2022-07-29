<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Utils\Assemblers;

final class CarCreateRequestAssembler
{
    public function __construct(
        private mixed $brand,
        private mixed $model,
        private mixed $year,
    ) {
    }

    public static function new(): self
    {
        return new self('Volvo', 'XC 90', 2020);
    }

    public function withBrand(mixed $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function withModel(mixed $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function withYear(mixed $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function assemble(): array
    {
        return array_filter([
            'year' => $this->year,
            'make' => $this->brand,
            'model' => $this->model,
        ]);
    }
}
