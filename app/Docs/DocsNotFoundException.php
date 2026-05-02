<?php

declare(strict_types=1);

namespace App\Docs;

final readonly class DocsNotFoundException
{
    public const string TYPE = 'array{errors: array{status: string, detail: string}[]}';

    public const array EXAMPLE = ['errors' => [['status' => '404', 'detail' => '存在しません。']]];
}
