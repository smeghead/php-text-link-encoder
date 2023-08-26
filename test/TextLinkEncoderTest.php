<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\TextLinkEncoder\TextLinkEncoder;

final class TextLinkEncoderTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testEncodeNull(): void
    {
        $sut = new TextLinkEncoder(null);

        $this->assertSame('', $sut->encode(), 'convert null to empty string.');
    }

    public function testEncodeNormalText(): void
    {
        $sut = new TextLinkEncoder('sample text.');

        $this->assertSame('sample text.', $sut->encode(), 'normal text.');
    }

    public function testEncodeTagCharacters(): void
    {
        $sut = new TextLinkEncoder('< & >');

        $this->assertSame('&lt; &amp; &gt;', $sut->encode(), 'tag character string.');
    }

    public function testEncodeUrl(): void
    {
        $sut = new TextLinkEncoder('http://www.example.com/');

        $this->assertSame('<a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>', $sut->encode(), 'link tag.');
    }

    public function testEncodeUrls(): void
    {
        $sut = new TextLinkEncoder('http://www.example.com/ http://www.example.com/index.html');

        $expected = '<a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>'
            . ' <a href="http://www.example.com/index.html" target="_blank" rel="noopener">http://www.example.com/index.html</a>';
        $this->assertSame($expected, $sut->encode(), 'multiple link tag.');
    }
}
