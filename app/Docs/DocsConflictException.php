<?php

declare(strict_types=1);

namespace App\Docs;

final readonly class DocsConflictException
{
    public const string TYPE = 'array{errors: array{source: array{pointer: string}, title: string, detail: string}[]}';

    public const array EXAMPLE = ['errors' => [['source' => ['pointer' => '/data/id'], 'title' => 'Invalid Id', 'detail' => '不正な値です。']]];
}
