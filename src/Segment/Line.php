<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

final class Line
{
    /** @var Segment[] */
    private array $segments = [];

    private function __construct()
    {
    }

    public function add(Segment $segment): void
    {
        $this->segments[] = $segment;
    }

    public static function fromSegment(Segment $segment): self
    {
        $line = new Line();
        $line->add($segment);
        return $line;
    }

    public static function fromEmptySegment(): self
    {
        return new Line();
    }

    public function toHtml(): string
    {
        return implode('', array_map(function (Segment $seg): string {
            return $seg->toHtml();
        }, $this->segments));
    }
}
