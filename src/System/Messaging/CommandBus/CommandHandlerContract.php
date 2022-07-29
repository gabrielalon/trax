<?php declare(strict_types=1);

namespace System\Messaging\CommandBus;

interface CommandHandlerContract
{
    public function handle(CommandContract $command): void;
}
