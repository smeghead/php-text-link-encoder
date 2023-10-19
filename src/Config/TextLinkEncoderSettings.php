<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Config;

final class TextLinkEncoderSettings
{
    private bool $brTag = true;
    private string $linkTarget = '_blank';
    private string $linkRel = 'noreferrer noopener';

    public function getBrTag(): bool
    {
        return $this->brTag;
    }

    public function getLinkTarget(): string
    {
        return $this->linkTarget;
    }

    public function getLinkRel(): string
    {
        return $this->linkRel;
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

    public function linkRel(string $linkRel): self
    {
        $cloned = clone $this;
        $cloned->linkRel = $linkRel;
        return $cloned;
    }
}
