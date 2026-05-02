<?php

namespace App\Http\Resources\Api\V1;

use App\Domain\Models\SampleUser\SampleUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SampleUser
 */
class SampleUserListGetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'users',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'birth_day' => $this->birthDay->format('Y/m/d'),
                'height' => $this->height->value,
                'gender' => $this->gender,
            ],
        ];
    }
}
