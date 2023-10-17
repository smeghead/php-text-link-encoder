<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

use Smeghead\TextLinkEncoder\Config\Settings;

interface Segment
{
    public static function getSearchRegex(): string;
    public function __construct(Settings $settings, string $segment);
    public function toHtml(): string;
}
