<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

final class Line
{
    /** @var Segment[] */
    private array $segments = [];

    public function __construct()
    {
    }

    public function add(Segment $segment): void
    {
        $this->segments[] = $segment;
    }

    public function toHtml(): string
    {
        return implode('', array_map(function (Segment $seg): string {
            return $seg->toHtml();
        }, $this->segments));
    }
}
