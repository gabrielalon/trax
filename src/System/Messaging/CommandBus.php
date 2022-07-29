<?php

namespace System\Messaging;

use System\Messaging\CommandBus\CommandContract;
use System\Messaging\CommandBus\CommandHandlerContract;

interface CommandBus
{
    public function dispatch(CommandContract $command): void;

    /**
     * @param array<class-string<CommandContract>,class-string<CommandHandlerContract>> $map
     * @return void
     */
    public function map(array $map): void;
}
