<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\ListGetApplicationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SampleUserListGetRequest;
use App\Http\Resources\Api\V1\SampleUserListGetCollection;
use Illuminate\Http\Request;

class SampleUserListGetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SampleUserListGetRequest $request): SampleUserListGetCollection
    {
        $command = $request->toDto();
        $service = new ListGetApplicationService;
        $data = $service->handle($command);

        return new SampleUserListGetCollection($data, $command);
    }
}
