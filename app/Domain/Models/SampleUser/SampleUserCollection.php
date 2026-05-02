<?php

declare(strict_types=1);

namespace App\Domain\Models\SampleUser;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * class SampleUserCollection
 *
 * @implements IteratorAggregate<SampleUser>
 */
final class SampleUserCollection implements Countable, IteratorAggregate
{
    /**
     * constructor
     *
     * @param  array<SampleUser>  $attributes  attributes
     */
    public function __construct(
        private array $attributes = []
    ) {}

    /**
     * add
     *
     * @param  SampleUser  $sampleUser  SampleUser
     */
    public function add(SampleUser $sampleUser): void
    {
        $this->attributes[] = $sampleUser;
    }

    public function count(): int
    {
        return count($this->attributes);
    }

    /**
     * @return array<SampleUser>
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * getIterator
     *
     * @return Traversable<int,SampleUser>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->attributes);
    }
}
