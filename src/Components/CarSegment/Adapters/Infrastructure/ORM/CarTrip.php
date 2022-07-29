<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\ORM;

use Components\CarSegment\Adapters\Infrastructure\Eloquent\CarTripBuilder;
use Database\Factories\CarTripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @mixin CarTripBuilder
 *
 * @method static CarTripBuilder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method CarTrip firstOrNew(array $attributes = [], array $values = [])
 * @method CarTrip firstOrFail(array $columns = ['*'])
 * @method CarTrip firstOrCreate(array $attributes, array $values = [])
 * @method CarTrip firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method CarTrip firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method CarTrip updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 * @method static CarTripFactory factory(integer $count = null, array $state = [])
 *
 * @property string $id
 * @property string $car_id
 * @property integer $user_id
 * @property Carbon $date
 * @property float $miles
 *
 * @property-read Car $car
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
final class CarTrip extends Eloquent implements HasUuid
{
    use HasFactory, HasUuidTrait;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    /** @var string[] */
    protected $casts = [
        'date'       => 'datetime',
        'miles'      => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function newEloquentBuilder($query): CarTripBuilder
    {
        return new CarTripBuilder($query);
    }

    protected static function newFactory(): CarTripFactory
    {
        return CarTripFactory::new();
    }

    public function car(): HasOne
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }
}
