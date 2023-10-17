<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Config;

final class Settings
{
    private bool $brTag = true;
    private string $linkTarget = '_blank';

    public function getBrTag(): bool
    {
        return $this->brTag;
    }

    public function getLinkTarget(): string
    {
        return $this->linkTarget;
    }

    public function convertNewLineToBrTag(bool $value): self
    {
        $cloned = clone $this;
        $cloned->brTag = $value;
        return $cloned;
    }

    public function linkTarget(string $linkTarget): self
    {
        $cloned = clone $this;
        $cloned->linkTarget = $linkTarget;
        return $cloned;
    }
}
