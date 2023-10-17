<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

use Smeghead\TextLinkEncoder\Config\Settings;

final class UrlSegment implements Segment
{
    public static function getSearchRegex(): string
    {
        return '/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/';
    }

    public function __construct(private Settings $settings, private string $segment)
    {
    }

    public function toHtml(): string
    {
        $encoded = htmlspecialchars($this->segment, ENT_QUOTES);
        return sprintf(
            '<a href="%s" target="%s" rel="noopener">%s</a>',
            $encoded,
            htmlspecialchars($this->settings->getLinkTarget(), ENT_QUOTES),
            $encoded
        );
    }
}
