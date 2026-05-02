<?php

declare(strict_types=1);

namespace App\Domain\Models\SampleUser;

use App\Domain\Models\SampleUser\Type\Gender;
use App\Domain\Models\SampleUser\Type\Height;
use DateTime;

final readonly class SampleUser
{
    public function __construct(
        public int $id,
        public string $name,
        public DateTime $birthDay,
        public Height $height,
        public Gender $gender
    ) {}
}
