<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Segment;

interface Segment
{
    public static function getSearchRegex(): string;
    public function __construct(string $segment);
    public function toHtml(): string;
}
