<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\ORM;

use Components\CarSegment\Adapters\Infrastructure\Eloquent\CarBuilder;
use Components\CarSegment\Adapters\Infrastructure\Eloquent\WithBrandName;
use Components\CarSegment\Adapters\Infrastructure\Eloquent\WithModelName;
use Components\CarSegment\Adapters\Infrastructure\Eloquent\WithYear;
use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @mixin CarBuilder
 *
 * @method static CarBuilder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method Car firstOrNew(array $attributes = [], array $values = [])
 * @method Car firstOrFail(array $columns = ['*'])
 * @method Car firstOrCreate(array $attributes, array $values = [])
 * @method Car firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method Car firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method Car updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 * @method static CarFactory factory(integer $count = null, array $state = [])
 *
 * @property string $id
 * @property string $model_id
 * @property string $generation_id
 *
 * @property-read CarModel $model
 * @property-read CarGeneration $generation
 * @property-read CarTrip[]|Collection $trips
 * @property-read CarOwner[]|Collection $owners
 *
 * @property-read string $brand_name
 * @property-read string $model_name
 * @property-read integer $year
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
final class Car extends Eloquent implements HasUuid
{
    use HasFactory, HasUuidTrait, WithBrandName, WithModelName, WithYear;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    /** @var string[] */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function model(): HasOne
    {
        return $this->hasOne(CarModel::class, 'id', 'model_id');
    }

    public function generation(): HasOne
    {
        return $this->hasOne(CarGeneration::class, 'id', 'generation_id');
    }

    public function owners(): HasMany
    {
        return $this->hasMany(CarOwner::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(CarTrip::class, 'car_id', 'id');
    }

    public function newEloquentBuilder($query)
    {
        return new CarBuilder($query);
    }

    public static function newFactory(): CarFactory
    {
        return CarFactory::new();
    }
}
