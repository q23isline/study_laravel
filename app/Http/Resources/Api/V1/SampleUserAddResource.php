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
                'id' => $this->id,
                'attributes' => [
                    'name' => $this->name,
                    'birth_day' => $this->birthDay->format('Y/m/d'),
                    'height' => $this->height->value,
                    'gender' => $this->gender,
                ],
            ],
            'links' => [
                'self' => $request->getPathInfo().'/'.$this->id,
            ],
        ];
    }
}
