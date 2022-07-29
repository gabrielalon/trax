<?php declare(strict_types=1);

namespace System\Commands;

use Psr\Log\LoggerInterface;
use System\Messaging\CommandBus\CommandContract;

final class LogCommand
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function handle(CommandContract $command, \Closure $next): mixed
    {
        $result = $next($command);

        $this->logger->debug('Command handled: ' . get_class($command));

        return $result;
    }
}
