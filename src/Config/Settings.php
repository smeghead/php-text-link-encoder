<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Config;

final class Settings
{
    private bool $brTag = true;

    public function getBrTag(): bool
    {
        return $this->brTag;
    }

    public function convertNewLineToBrTag(bool $value): self
    {
        $cloned = clone $this;
        $cloned->brTag = $value;
        return $cloned;
    }
}
