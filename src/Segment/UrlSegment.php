<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

final class UrlSegment implements Segment {
    public static function getSearchRegex(): string
    {
        return '/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/';
    }

    public function __construct(private string $segment)
    {
    }

    public function toHtml(): string
    {
        return sprintf(
            '<a href="%s" target="_blank" rel="noopener">%s</a>',
            htmlspecialchars($this->segment, ENT_QUOTES),
            htmlspecialchars($this->segment, ENT_QUOTES)
        );
    }
}