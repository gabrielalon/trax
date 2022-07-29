<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Utils\Seeders;

use App\User;
use Database\Factories\UserFactory;

final class UsersSeeder
{
    public static function seedOne(array $data = []): User
    {
        return UserFactory::new()->createOne($data);
    }
}
