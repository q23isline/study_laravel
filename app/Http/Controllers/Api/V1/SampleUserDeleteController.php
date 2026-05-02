<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\DeleteApplicationService;
use App\ApplicationService\SampleUsers\DeleteCommand;
use App\Docs\DocsNotFoundException;
use App\Domain\Shared\Exception\NotFoundException;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\PathParameter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

#[Group('SampleUsers API')]
class SampleUserDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    #[PathParameter('id', description: 'ID', example: 1)]
    #[\Dedoc\Scramble\Attributes\Response(404, type: DocsNotFoundException::TYPE, examples: [DocsNotFoundException::EXAMPLE])]
    public function __invoke(Request $request, int $id): Response|JsonResponse
    {
        $service = new DeleteApplicationService;

        try {
            $service->handle(new DeleteCommand($id));
        } catch (NotFoundException $e) {
            return response()->json($e->format(), $e->getCode());
        }

        return response()->noContent();
    }
}
