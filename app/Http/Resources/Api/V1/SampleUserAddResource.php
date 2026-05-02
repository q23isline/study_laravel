<?php

namespace App\Http\Resources\Api\V1;

use App\Domain\Models\SampleUser\SampleUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SampleUser
 */
class SampleUserAddResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'type' => 'users',
                /**
                 * ID
                 *
                 * @example 1
                 */
                'id' => $this->id,
                'attributes' => [
                    /**
                     * 氏名
                     *
                     * @example 田中太郎
                     */
                    'name' => $this->name,
                    /**
                     * 生年月日
                     *
                     * @example 2000/01/01
                     */
                    'birth_day' => $this->birthDay->format('Y/m/d'),
                    /**
                     * 身長（cm）
                     *
                     * @example 170.5
                     */
                    'height' => $this->height->value,
                    /**
                     * 性別（1: 男性, 2: 女性）
                     */
                    'gender' => $this->gender,
                ],
            ],
            'links' => [
                /**
                 * @example /api/v1/sample-users/1
                 */
                'self' => $request->getPathInfo().'/'.$this->id,
            ],
        ];
    }
}
