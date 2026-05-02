<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\AddApplicationService;
use App\Docs\DocsValidateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SampleUserAddRequest;
use App\Http\Resources\Api\V1\SampleUserAddResource;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

#[Group('SampleUsers API')]
class SampleUserAddController extends Controller
{
    /**
     * Handle the incoming request.
     */
    #[\Dedoc\Scramble\Attributes\Response(422, type: DocsValidateException::TYPE, examples: [DocsValidateException::EXAMPLE_ENTITY])]
    public function __invoke(SampleUserAddRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $service = new AddApplicationService;
        $data = $service->handle($dto);

        return (new SampleUserAddResource($data))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
