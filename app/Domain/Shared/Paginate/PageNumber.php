<?php

declare(strict_types=1);

namespace App\Domain\Shared\Paginate;

use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;

final readonly class PageNumber
{
    public function __construct(
        public int $value
    ) {
        $errors = [];
        if ($value <= 0) {
            $errors[] = new ExceptionItem('pageNumber', 'Invalid Query Parameter', '不正な値です。');
            throw new ValidateException($errors);
        }
    }
}
