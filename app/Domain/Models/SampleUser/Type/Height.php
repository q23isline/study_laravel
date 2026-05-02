<?php

declare(strict_types=1);

namespace App\Domain\Models\SampleUser\Type;

/**
 * TODO:
 *  float は丸め誤差が発生するため、厳密な値比較や金額計算などには不向き。
 *  将来的には「スケール付き整数（例: ×10）」や「文字列ベース」での保持に変更すること。
 */
final readonly class Height
{
    public function __construct(
        public float $value
    ) {}
}
