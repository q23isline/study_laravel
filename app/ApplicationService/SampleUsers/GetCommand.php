<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

final readonly class GetCommand
{
    public function __construct(
        public int $id
    ) {}
}
