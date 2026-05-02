<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\GetApplicationService;
use App\ApplicationService\SampleUsers\GetCommand;
use App\Docs\DocsNotFoundException;
use App\Domain\Shared\Exception\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SampleUserGetResource;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\PathParameter;
use Dedoc\Scramble\Attributes\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

#[Group('SampleUsers API')]
class SampleUserGetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    #[PathParameter('id', description: 'ID', example: 1)]
    #[Response(404, type: DocsNotFoundException::TYPE, examples: [DocsNotFoundException::EXAMPLE])]
    public function __invoke(Request $request, int $id): SampleUserGetResource|JsonResponse
    {
        $service = new GetApplicationService;

        try {
            $data = $service->handle(new GetCommand($id));
        } catch (NotFoundException $e) {
            return response()->json($e->format(), $e->getCode());
        }

        return new SampleUserGetResource($data);
    }
}
