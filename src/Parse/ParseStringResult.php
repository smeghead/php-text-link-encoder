<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Parse;

final class ParseStringResult
{
    public int $nextPosition;
    public string $class;
    public string $matchString;

    public function __construct(
        int $nextPosition,
        string $class,
        string $matchString
    ) {
        $this->nextPosition = $nextPosition;
        $this->class = $class;
        $this->matchString = $matchString;
    }
}
