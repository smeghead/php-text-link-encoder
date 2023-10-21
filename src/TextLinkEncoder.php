<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder;

use Smeghead\TextLinkEncoder\Config\TextLinkEncoderSettings;
use Smeghead\TextLinkEncoder\Parse\ParseString;
use Smeghead\TextLinkEncoder\Segment\EmailSegment;
use Smeghead\TextLinkEncoder\Segment\Line;
use Smeghead\TextLinkEncoder\Segment\TextSegment;
use Smeghead\TextLinkEncoder\Segment\UrlSegment;

/**
 * Escape text containing URLs.
 * URL is output as a link tag.
 * A newline outputs <br>.
 * 
 * usage:
 * ```
 *   $encoder = new TextLinkEncoder();
 *   echo $encoder->encode('Web Site: http://www.example.com/');
 *   // -> Web Site: <a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>
 * ```
 */
final class TextLinkEncoder
{
    /**
     */
    public function __construct(private TextLinkEncoderSettings $settings)
    {
    }

    private const SEGMENT_CLASSES = [
        UrlSegment::class,
        EmailSegment::class,
    ];

    /**
     * @param string|null $text target text.
     * @return string encoded text.
     */
    public function encode($text): string
    {
        $lineStrings = preg_split('/\r?\n/', strval($text));
        $segmentLines = [];
        foreach ($lineStrings as $lineString) {
            $restText = $lineString;
            $line = new Line();
            while (mb_strlen($restText) > 0) {
                $parser = new ParseString($restText);
                $result = $parser->parse(self::SEGMENT_CLASSES);

                $position = $result->nextPosition;
                // URLより前の部分をエスケープしてpartsに格納する。
                $line->add(new TextSegment($this->settings, mb_substr($restText, 0, $position)));
                // URLをリンクに変換する。
                $line->add(new $result->class($this->settings, $result->matchString));
                $restText = mb_substr($restText, $position + mb_strlen($result->matchString));
            }
            $segmentLines[] = $line;
        }
        return implode(sprintf("%s\n", $this->settings->value()->brTag ? '<br>' : ''), array_map(function(Line $line): string {
            return $line->toHtml();
        }, $segmentLines));
    }
}
