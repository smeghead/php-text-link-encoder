<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

final class UrlSegment implements Segment
{
    public static function getSearchRegex(): string
    {
        return '/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/';
    }

    public function __construct(private string $segment)
    {
    }

    public function toHtml(): string
    {
        $encoded = htmlspecialchars($this->segment, ENT_QUOTES);
        return sprintf(
            '<a href="%s" target="_blank" rel="noopener">%s</a>',
            $encoded,
            $encoded
        );
    }
}
