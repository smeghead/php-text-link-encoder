<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder\Config;

final class TextLinkEncoderSettings
{
    private Value $value;

    public function __construct()
    {
        $this->value = new Value(true, '_blank', 'noreferrer noopener');
    }

    public function value(): Value
    {
        return $this->value;
    }

    public function convertNewLineToBrTag(bool $value): self
    {
        $cloned = clone $this;
        $cloned->value = clone $this->value;
        $cloned->value->brTag = $value;
        return $cloned;
    }

    public function linkTarget(string $linkTarget): self
    {
        $cloned = clone $this;
        $cloned->value = clone $this->value;
        $cloned->value->linkTarget = $linkTarget;
        return $cloned;
    }

    public function linkRel(string $linkRel): self
    {
        $cloned = clone $this;
        $cloned->value = clone $this->value;
        $cloned->value->linkRel = $linkRel;
        return $cloned;
    }
}

final class Value
{
    public bool $brTag;
    public string $linkTarget;
    public string $linkRel;

    public function __construct(
        bool $brTag,
        string $linkTarget,
        string $linkRel
    ) {
        $this->brTag = $brTag;
        $this->linkTarget = $linkTarget;
        $this->linkRel = $linkRel;
    }
}
