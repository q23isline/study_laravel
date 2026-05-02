<?php

declare(strict_types=1);

namespace App\Docs;

final readonly class DocsValidateException
{
    public const string TYPE = 'array{errors: array{source: array{pointer: string}, title: string, detail: string}[]}';

    public const array EXAMPLE_QUERY = ['errors' => [['source' => ['pointer' => '/page/number'], 'title' => '不正な値です。', 'detail' => '不正な値です。']]];

    public const array EXAMPLE_ENTITY = ['errors' => [['source' => ['pointer' => '/data/attributes/name'], 'title' => '不正な値です。', 'detail' => '不正な値です。']]];
}
