<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\ORM;

use App\User;
use Components\CarSegment\Adapters\Infrastructure\Eloquent\CarOwnerBuilder;
use Database\Factories\CarOwnerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @mixin CarOwnerBuilder
 *
 * @method static CarOwnerBuilder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method CarOwner firstOrNew(array $attributes = [], array $values = [])
 * @method CarOwner firstOrFail(array $columns = ['*'])
 * @method CarOwner firstOrCreate(array $attributes, array $values = [])
 * @method CarOwner firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method CarOwner firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method CarOwner updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 * @method static CarOwnerFactory factory(integer $count = null, array $state = [])
 *
 * @property string $id
 * @property string $car_id
 * @property integer $user_id
 *
 * @property-read Car $car
 * @property-read User $user
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
final class CarOwner extends Eloquent implements HasUuid
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

    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function newEloquentBuilder($query): CarOwnerBuilder
    {
        return new CarOwnerBuilder($query);
    }

    public static function newFactory(): CarOwnerFactory
    {
        return CarOwnerFactory::new();
    }
}
