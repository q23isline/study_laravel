<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

use App\Domain\Shared\Paginate\PageNumber;
use App\Domain\Shared\Paginate\PageSize;

final readonly class ListGetCommand
{
    public function __construct(
        public PageNumber $pageNumber,
        public PageSize $pageSize,
        public ?string $filterName = null,
        public ?string $sort = null
    ) {}
}
