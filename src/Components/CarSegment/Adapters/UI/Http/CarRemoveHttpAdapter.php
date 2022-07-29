<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http;

use Components\CarSegment\Application\Commands\RemoveCarOwner\RemoveCarOwner;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use System\Http\Controller;
use System\Http\Response\NoContent;
use System\Messaging\CommandBus;

final class CarRemoveHttpAdapter extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus,
    ) {
    }

    public function __invoke(string $carId, Request $request): Response
    {
        $this->commandBus->dispatch(RemoveCarOwner::fromRaw($request->user()->id, $carId));

        return NoContent::make();
    }
}
