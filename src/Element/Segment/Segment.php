<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Element\Segment;

use Smeghead\TextLinkEncoder\Config\TextLinkEncoderSettings;

interface Segment
{
    public static function getSearchRegex(): string;
    public function __construct(TextLinkEncoderSettings $settings, string $segment);
    public function toHtml(): string;
}
