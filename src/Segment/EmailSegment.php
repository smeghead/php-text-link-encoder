<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

use Smeghead\TextLinkEncoder\Config\Settings;

final class EmailSegment implements Segment
{
    public static function getSearchRegex(): string
    {
        return '/[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}/';
    }

    public function __construct(private Settings $settings, private string $segment)
    {
    }

    public function toHtml(): string
    {
        $encoded = htmlspecialchars($this->segment, ENT_QUOTES);
        return sprintf(
            '<a href="mailto:%s" target="%s" rel="noopener">%s</a>',
            $encoded,
            htmlspecialchars($this->settings->getLinkTarget(), ENT_QUOTES),
            $encoded
        );
    }
}
