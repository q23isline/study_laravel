<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

use DateTime;

final readonly class AddCommand
{
    public function __construct(
        public string $type,
        public string $name,
        public DateTime $birthDay,
        public string $height,
        public string $gender
    ) {}
}
