<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Element\Segment;

use Smeghead\TextLinkEncoder\Config\TextLinkEncoderSettings;

final class UrlSegment implements Segment
{
    private TextLinkEncoderSettings $settings;
    private string $segment;

    public static function getSearchRegex(): string
    {
        return '/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/';
    }

    public function __construct(TextLinkEncoderSettings $settings, string $segment)
    {
        $this->settings = $settings;
        $this->segment = $segment;
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
