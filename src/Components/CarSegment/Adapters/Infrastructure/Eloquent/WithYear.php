<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait WithYear
{
    protected function year(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->generation->year,
        );
    }
}
