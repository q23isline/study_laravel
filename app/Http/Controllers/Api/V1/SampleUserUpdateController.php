<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\UpdateApplicationService;
use App\Docs\DocsConflictException;
use App\Docs\DocsNotFoundException;
use App\Docs\DocsValidateException;
use App\Domain\Shared\Exception\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SampleUserUpdateRequest;
use App\Http\Resources\Api\V1\SampleUserUpdateResource;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\PathParameter;
use Dedoc\Scramble\Attributes\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

#[Group('SampleUsers API')]
class SampleUserUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    #[PathParameter('id', description: 'ID', example: 1)]
    #[Response(404, type: DocsNotFoundException::TYPE, examples: [DocsNotFoundException::EXAMPLE])]
    #[Response(409, type: DocsConflictException::TYPE, examples: [DocsConflictException::EXAMPLE])]
    #[Response(422, type: DocsValidateException::TYPE, examples: [DocsValidateException::EXAMPLE_ENTITY])]
    public function __invoke(SampleUserUpdateRequest $request, int $id): SampleUserUpdateResource|JsonResponse
    {
        $dto = $request->toDto();

        $service = new UpdateApplicationService;

        try {
            $data = $service->handle($dto);
        } catch (NotFoundException $e) {
            return response()->json($e->format(), $e->getCode());
        }

        return new SampleUserUpdateResource($data);
    }
}
