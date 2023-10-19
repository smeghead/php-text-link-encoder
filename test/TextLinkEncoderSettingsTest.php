<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\TextLinkEncoder\Config\TextLinkEncoderSettings;

final class TextLinkEncoderSettingsTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testDefaultSettings(): void
    {
        $sut = new TextLinkEncoderSettings();

        $this->assertSame(true, $sut->getBrTag(), 'make new line <br>');
    }

    public function testNoBrTag(): void
    {
        $sut = new TextLinkEncoderSettings();
        $sut2 = $sut->convertNewLineToBrTag(false);

        $this->assertSame(true, $sut->getBrTag(), 'original: not changed');
        $this->assertSame(false, $sut2->getBrTag(), 'new: updated');
    }

    public function testLinkTarget(): void
    {
        $sut = new TextLinkEncoderSettings();
        $sut2 = $sut->linkTarget('_self');

        $this->assertSame('_blank', $sut->getLinkTarget(), 'original: not changed');
        $this->assertSame('_self', $sut2->getLinkTarget(), 'new: updated');
    }

    public function testLinkRel(): void
    {
        $sut = new TextLinkEncoderSettings();
        $sut2 = $sut->linkRel('alternate');

        $this->assertSame('noreferrer noopener', $sut->getLinkRel(), 'original: not changed');
        $this->assertSame('alternate', $sut2->getLinkRel(), 'new: updated');
    }
}
