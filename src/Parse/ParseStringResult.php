<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Parse;

final class ParseStringResult
{
    public function __construct(
        public int $nextPosition,
        public string $class,
        public string $matchString
    )
    {
    }
}
