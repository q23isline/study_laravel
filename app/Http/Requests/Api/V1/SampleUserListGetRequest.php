<?php

namespace App\Http\Requests\Api\V1;

use App\ApplicationService\SampleUsers\ListGetCommand;
use App\Domain\Shared\Paginate\PageNumber;
use App\Domain\Shared\Paginate\PageSize;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SampleUserListGetRequest extends FormRequest
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
            /**
             * 氏名の検索キーワード
             *
             * @example 田中
             */
            'filter.name' => ['nullable', 'string'],
            /**
             * 並び順（先頭マイナス - は降順、他昇順）
             */
            'sort' => ['nullable', 'in:name,-name,birth_day,-birth_day,height,-height,gender,-gender'],
            /**
             * 表示するページ
             *
             * @default 1
             */
            'page.number' => ['nullable', 'integer', 'min:1'],
            /**
             * ページ内で表示する件数
             *
             * @default 10
             */
            'page.size' => ['nullable', 'integer', 'min:1'],
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

    public function toDto(): ListGetCommand
    {
        $pageNumber = $this->input('page.number', '1');
        $pageSize = $this->input('page.size', '10');
        $filterName = $this->input('filter.name');
        $sort = $this->input('sort');

        // rules() で型保証しているが Larastan が型認識できないため assert で保証する（本番では実行コストなし）
        assert(\is_string($pageNumber));
        assert(\is_string($pageSize));
        assert(\is_string($filterName) || $filterName === null);
        assert(\is_string($sort) || $sort === null);

        return new ListGetCommand(
            new PageNumber((int) $pageNumber),
            new PageSize((int) $pageSize),
            $filterName,
            $sort
        );
    }
}
