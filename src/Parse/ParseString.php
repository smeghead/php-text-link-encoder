<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Parse;

use Smeghead\TextLinkEncoder\Element\Segment\TextSegment;

final class ParseString
{
    public function __construct(
        private string $restString
    )
    {
    }

    /**
     * @param string[] $classes
     */
    public function parse(array $classes): ParseStringResult
    {
        $matcheResults = [];
        foreach ($classes as $class) {
            $regexp = $class::getSearchRegex();
            if ( ! preg_match($regexp, $this->restString, $matches)) {
                continue;
            }
            $index = mb_strpos($this->restString, $matches[0]);
            $matcheResults[$index] = new ParseStringResult($index, $class, $matches[0]);
        }
        if (count($matcheResults) === 0) {
            return new ParseStringResult(0, TextSegment::class, $this->restString);
        }
        ksort($matcheResults);
        return array_shift($matcheResults);
    }
}
