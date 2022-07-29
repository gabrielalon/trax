<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\ORM;

use Database\Factories\CarBrandFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @mixin Builder
 *
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method CarBrand firstOrNew(array $attributes = [], array $values = [])
 * @method CarBrand firstOrFail(array $columns = ['*'])
 * @method CarBrand firstOrCreate(array $attributes, array $values = [])
 * @method CarBrand firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method CarBrand firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method CarBrand updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 * @method static CarBrandFactory factory(integer $count = null, array $state = [])
 *
 * @property string $id
 * @property string $name
 * @property CarModel[]|Collection $models
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
final class CarBrand extends Eloquent implements HasUuid
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'brand_id');
    }

    public static function newFactory(): CarBrandFactory
    {
        return CarBrandFactory::new();
    }
}
