<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\GetApplicationService;
use App\ApplicationService\SampleUsers\GetCommand;
use App\Domain\Shared\Exception\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SampleUserGetResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SampleUserGetController extends Controller
{
    /**
     * Handle the incoming request.
     */
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
