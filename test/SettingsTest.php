<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\TextLinkEncoder\Config\Settings;

final class SettingsTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testDefaultSettings(): void
    {
        $sut = new Settings();

        $this->assertSame(true, $sut->getBrTag(), 'make new line <br>');
    }

    public function testNoBrTag(): void
    {
        $sut = new Settings();
        $sut2 = $sut->convertNewLineToBrTag(false);

        $this->assertSame(true, $sut->getBrTag(), 'original: not changed');
        $this->assertSame(false, $sut2->getBrTag(), 'new: updated');
    }
}
