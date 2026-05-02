<?php

namespace App\Http\Resources\Api\V1;

use App\ApplicationService\SampleUsers\ListGetCommand;
use App\Domain\Models\SampleUser\SampleUserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SampleUserListGetCollection extends ResourceCollection
{
    private ListGetCommand $command;

    private int $total;

    /**
     * @param  array{count: int, users: SampleUserCollection}  $resource
     */
    public function __construct(array $resource, ListGetCommand $command)
    {
        parent::__construct($resource['users']->toArray());
        $this->command = $command;
        $this->total = $resource['count'];
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => SampleUserListGetResource::collection($this->collection),
        ];
    }

    /**
     * @return array<int|string, mixed>
     */
    public function with(Request $request): array
    {
        $totalPage = ceil($this->total / $this->command->pageSize->value);

        return [
            'meta' => [
                /**
                 * 全件数
                 *
                 * @example 1
                 */
                'total' => $this->total,
                'page' => [
                    /**
                     * 表示しているページ数
                     *
                     * @example 1
                     */
                    'number' => $this->command->pageNumber->value,
                    /**
                     * 表示する件数
                     *
                     * @example 10
                     */
                    'size' => $this->command->pageSize->value,
                    /**
                     * 全ページ数
                     *
                     * @example 1
                     */
                    'total_pages' => $totalPage,
                ],
            ],
            'links' => [
                /**
                 * @example /api/v1/sample-users?page%5Bnumber%5D=1
                 */
                'self' => $this->buildLink($request, 0),
                /**
                 * 次のページのリンク
                 *
                 * @example null
                 */
                'next' => $this->command->pageNumber->value < $totalPage
                    ? $this->buildLink($request, +1)
                    : null,
                /**
                 * 前のページのリンク
                 *
                 * @example null
                 */
                'prev' => $this->command->pageNumber->value > 1
                    ? $this->buildLink($request, -1)
                    : null,
            ],
        ];
    }

    private function buildLink(Request $request, int $diff): string
    {
        $query = $request->query();
        // query() は配列前提で扱う（Larastan は mixed 扱いのため無視）
        $query['page']['number'] = $this->command->pageNumber->value + $diff; // @phpstan-ignore offsetAccess.nonOffsetAccessible

        return $request->getPathInfo().'?'.http_build_query($query);
    }
}
