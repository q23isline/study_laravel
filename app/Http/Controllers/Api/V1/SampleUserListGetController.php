<?php

namespace App\Http\Controllers\Api\V1;

use App\ApplicationService\SampleUsers\ListGetApplicationService;
use App\Docs\DocsValidateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SampleUserListGetRequest;
use App\Http\Resources\Api\V1\SampleUserListGetCollection;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\Response;
use Illuminate\Http\Request;

#[Group('SampleUsers API')]
class SampleUserListGetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    #[Response(422, type: DocsValidateException::TYPE, examples: [DocsValidateException::EXAMPLE_QUERY])]
    public function __invoke(SampleUserListGetRequest $request): SampleUserListGetCollection
    {
        $command = $request->toDto();
        $service = new ListGetApplicationService;
        $data = $service->handle($command);

        return new SampleUserListGetCollection($data, $command);
    }
}
