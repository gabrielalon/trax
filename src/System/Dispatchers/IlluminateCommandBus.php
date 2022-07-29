<?php declare(strict_types=1);

namespace System\Dispatchers;

use Illuminate\Bus\Dispatcher;
use System\Commands\LogCommand;
use System\Commands\UseDatabaseTransactions;
use System\Messaging\CommandBus;

final class IlluminateCommandBus implements CommandBus
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {
        $this->bus->pipeThrough([UseDatabaseTransactions::class, LogCommand::class]);
    }

    public function dispatch(CommandBus\CommandContract $command): void
    {
        $this->bus->dispatch($command);
    }

    public function map(array $map): void
    {
        $this->bus->map($map);
    }
}
