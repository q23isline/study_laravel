<?php

declare(strict_types=1);

namespace App\Domain\Shared\Paginate;

use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;

final readonly class PageSize
{
    public function __construct(
        public int $value
    ) {
        $errors = [];
        if ($value <= 0) {
            $errors[] = new ExceptionItem('pageSize', 'Invalid Query Parameter', '不正な値です。');
            throw new ValidateException($errors);
        }
    }
}
