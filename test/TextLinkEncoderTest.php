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
        $sut = new TextLinkEncoder();

        $this->assertSame('', $sut->encode(null), 'convert null to empty string.');
    }

    public function testEncodeNormalText(): void
    {
        $sut = new TextLinkEncoder();

        $this->assertSame('sample text.', $sut->encode('sample text.'), 'normal text.');
    }

    public function testEncodeTagCharacters(): void
    {
        $sut = new TextLinkEncoder();

        $this->assertSame('&lt; &amp; &gt;', $sut->encode('< & >'), 'tag character string.');
    }

    public function testEncodeUrl(): void
    {
        $sut = new TextLinkEncoder();

        $this->assertSame('<a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>', $sut->encode('http://www.example.com/'), 'link tag.');
    }

    public function testEncodeUrls(): void
    {
        $sut = new TextLinkEncoder();

        $expected = '<a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>'
            . ' <a href="http://www.example.com/index.html" target="_blank" rel="noopener">http://www.example.com/index.html</a>';
        $this->assertSame($expected, $sut->encode('http://www.example.com/ http://www.example.com/index.html'), 'multiple link tag.');
    }

    public function testEncodeMultipleLines(): void
    {
        $sut = new TextLinkEncoder();

        $src = <<<EOS
        url > https://www.example.com/
        url > http://www.example.com/
EOS;
        $expected = <<<EOS
        url &gt; <a href="https://www.example.com/" target="_blank" rel="noopener">https://www.example.com/</a><br>
        url &gt; <a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>
EOS;
        $this->assertSame($expected, $sut->encode($src), 'multiple lines.');
    }
}
