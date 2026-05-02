<?php

declare(strict_types=1);

namespace App\Domain\Models\SampleUser\Type;

enum Gender: string
{
    case Male = '1';
    case Female = '2';
}
