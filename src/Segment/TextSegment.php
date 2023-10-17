<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

use Smeghead\TextLinkEncoder\Config\Settings;

final class TextSegment implements Segment
{
    public static function getSearchRegex(): string
    {
        return '/.*/';
    }

    public function __construct(private Settings $settings, private string $segment)
    {
    }

    public function toHtml(): string
    {
        return htmlspecialchars($this->segment, ENT_QUOTES);
    }
}
