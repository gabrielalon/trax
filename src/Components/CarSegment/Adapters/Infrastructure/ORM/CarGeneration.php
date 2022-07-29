<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\ORM;

use Database\Factories\CarGenerationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
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
 * @method CarGeneration firstOrNew(array $attributes = [], array $values = [])
 * @method CarGeneration firstOrFail(array $columns = ['*'])
 * @method CarGeneration firstOrCreate(array $attributes, array $values = [])
 * @method CarGeneration firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method CarGeneration firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method CarGeneration updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 * @method static CarGenerationFactory factory(integer $count = null, array $state = [])
 *
 * @property string $id
 * @property integer $year
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
final class CarGeneration extends Eloquent implements HasUuid
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
        'year'       => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function newFactory(): CarGenerationFactory
    {
        return CarGenerationFactory::new();
    }
}
