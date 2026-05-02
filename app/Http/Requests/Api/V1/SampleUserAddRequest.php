<?php

namespace App\Http\Requests\Api\V1;

use App\ApplicationService\SampleUsers\AddCommand;
use DateTime;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SampleUserAddRequest extends FormRequest
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
            /**
             * 氏名
             *
             * @example 田中太郎
             */
            'data.attributes.name' => ['required', 'string', 'max:100'],
            /**
             * 生年月日
             *
             * @example 2000/01/01
             */
            'data.attributes.birth_day' => ['required', 'date_format:Y/m/d'],
            /**
             * 身長（cm）
             *
             * @example 170.5
             */
            'data.attributes.height' => ['required', 'numeric'],
            /**
             * 性別（1: 男性, 2: 女性）
             */
            'data.attributes.gender' => ['required', 'in:1,2'],
        ];
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

    public function toDto(): AddCommand
    {
        $type = $this->input('data.type');
        $name = $this->input('data.attributes.name');
        $birthDay = $this->input('data.attributes.birth_day');
        $height = $this->input('data.attributes.height');
        $gender = $this->input('data.attributes.gender');

        // rules() で型保証しているが Larastan が型認識できないため assert で保証する（本番では実行コストなし）
        assert(\is_string($type));
        assert(\is_string($name));
        assert(\is_string($birthDay));
        assert(\is_float($height));
        assert(\is_string($gender));

        return new AddCommand(
            $type,
            $name,
            new DateTime($birthDay),
            (string) $height,
            $gender
        );
    }
}
