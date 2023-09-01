<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

final class EmailSegment implements Segment
{
    public static function getSearchRegex(): string
    {
        return '/[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}/';
    }

    public function __construct(private string $segment)
    {
    }

    public function toHtml(): string
    {
        $encoded = htmlspecialchars($this->segment, ENT_QUOTES);
        return sprintf(
            '<a href="mailto:%s" target="_blank" rel="noopener">%s</a>',
            $encoded,
            $encoded
        );
    }
}
