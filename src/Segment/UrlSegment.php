<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

use Smeghead\TextLinkEncoder\Config\TextLinkEncoderSettings;

final class UrlSegment implements Segment
{
    public static function getSearchRegex(): string
    {
        return '/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/';
    }

    public function __construct(private TextLinkEncoderSettings $settings, private string $segment)
    {
    }

    public function toHtml(): string
    {
        $encoded = htmlspecialchars($this->segment, ENT_QUOTES);
        return sprintf(
            '<a href="%s" target="%s" rel="noreferrer noopener">%s</a>',
            $encoded,
            htmlspecialchars($this->settings->value()->linkTarget, ENT_QUOTES),
            $encoded
        );
    }
}
