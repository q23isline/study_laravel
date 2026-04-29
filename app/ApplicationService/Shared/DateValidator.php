<?php

declare(strict_types=1);

namespace App\ApplicationService\Shared;

use DateTime;

final class DateValidator
{
    /**
     * 日付が正しいか
     */
    public static function isCorrectDate(string $date, string $format): bool
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }
}
