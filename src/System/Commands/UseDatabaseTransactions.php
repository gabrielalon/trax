<?php declare(strict_types=1);

namespace System\Commands;

use Illuminate\Support\Facades\DB;
use System\Messaging\CommandBus\CommandContract;

final class UseDatabaseTransactions
{
    public function handle(CommandContract $command, \Closure $next): mixed
    {
        return DB::transaction(static function() use ($command, $next)
        {
            return $next($command);
        });
    }
}
