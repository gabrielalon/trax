<?php

namespace App;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;

/**
 * @mixin Builder
 *
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method User firstOrNew(array $attributes = [], array $values = [])
 * @method User firstOrFail(array $columns = ['*'])
 * @method User firstOrCreate(array $attributes, array $values = [])
 * @method User firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method User firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method User updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(integer $id, array $columns = ['*'])
 * @method static static findOrNew(integer $id, array $columns = ['*'])
 * @method static null|static find(integer $id, array $columns = ['*'])
 * @method static UserFactory factory(integer $count = null, array $state = [])
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
final class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
