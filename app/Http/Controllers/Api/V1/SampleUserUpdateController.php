<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\UpdateApplicationService;
use App\Domain\Shared\Exception\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SampleUserUpdateRequest;
use App\Http\Resources\Api\V1\SampleUserUpdateResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SampleUserUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
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
