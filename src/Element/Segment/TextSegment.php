<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Element\Segment;

use Smeghead\TextLinkEncoder\Config\TextLinkEncoderSettings;

final class TextSegment implements Segment
{
    // @phpstan-ignore-next-line
    private TextLinkEncoderSettings $settings;
    private string $segment;

    public static function getSearchRegex(): string
    {
        return '/.*/';
    }

    public function __construct(TextLinkEncoderSettings $settings, string $segment)
    {
        $this->settings = $settings;
        $this->segment = $segment;
    }

    public function toHtml(): string
    {
        return htmlspecialchars($this->segment, ENT_QUOTES);
    }
}
