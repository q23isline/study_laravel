<?php

namespace App\Http\Requests\Api\V1;

use App\ApplicationService\SampleUsers\UpdateCommand;
use App\Domain\Shared\Exception\ConflictException;
use App\Domain\Shared\Exception\ExceptionItem;
use DateTime;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SampleUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.type' => ['required', 'in:users'],
            'data.id' => ['required', 'integer'],
            'data.attributes.name' => ['required', 'string', 'max:100'],
            'data.attributes.birth_day' => ['required', 'date_format:Y/m/d'],
            'data.attributes.height' => ['required', 'numeric'],
            'data.attributes.gender' => ['required', 'in:1,2'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'path_id' => $this->route('id'),
        ]);
    }

    protected function passedValidation(): void
    {
        // 競合チェック
        $requestBodyId = $this->input('data.id');
        $pathId = $this->input('path_id');

        assert(\is_int($requestBodyId));
        assert(\is_string($pathId));

        if ($requestBodyId !== (int) $pathId) {
            $errors[] = new ExceptionItem('/data/id', 'Invalid Id', '不正な値です。');
            throw new ConflictException($errors);
        }
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*' => '不正な値です。',
        ];
    }

    public function toDto(): UpdateCommand
    {
        $type = $this->input('data.type');
        $id = $this->input('data.id');
        $name = $this->input('data.attributes.name');
        $birthDay = $this->input('data.attributes.birth_day');
        $height = $this->input('data.attributes.height');
        $gender = $this->input('data.attributes.gender');

        // rules() で型保証しているが Larastan が型認識できないため assert で保証する（本番では実行コストなし）
        assert(\is_string($type));
        assert(\is_int($id));
        assert(\is_string($name));
        assert(\is_string($birthDay));
        assert(\is_float($height));
        assert(\is_string($gender));

        return new UpdateCommand(
            $type,
            $id,
            $name,
            new DateTime($birthDay),
            (string) $height,
            $gender
        );
    }
}
