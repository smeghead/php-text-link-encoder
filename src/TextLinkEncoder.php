<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder;

use Smeghead\TextLinkEncoder\Segment\Segment;
use Smeghead\TextLinkEncoder\Segment\TextSegment;
use Smeghead\TextLinkEncoder\Segment\UrlSegment;

/**
 * Escape text containing URLs.
 * URL is output as a link tag.
 * A newline outputs <br>.
 * 
 * usage:
 * ```
 *   $encoder = new TextLinkEncoder('Web Site: http://www.example.com/');
 *   echo $encoder->encode();
 *   // -> Web Site: <a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>
 * ```
 */
final class TextLinkEncoder
{
    private string $text;

    /**
     * @param string|null $text target text.
     */
    public function __construct(?string $text)
    {
        $this->text = strval($text);
    }

    /**
     * @return string encoded text.
     */
    public function encode(): string
    {
        $lines = preg_split('/\r?\n/', $this->text);
        $segmentLines = [];
        foreach ($lines as $line) {
            if (preg_match_all(UrlSegment::getSearchRegex(), $line, $matches)) {
                try {
                    $restText = $line;
                    $segments = [];
                    foreach ($matches[0] as $url) {
                        $position = mb_strpos($restText, $url);
                        if ($position === false) {
                            throw new \Exception('failed to search url string.');
                        }
                        // URLより前の部分をエスケープしてpartsに格納する。
                        $segments[] = new TextSegment(mb_substr($restText, 0, $position));
                        // URLをリンクに変換する。
                        $segments[] = new UrlSegment($url);
                        $restText = mb_substr($restText, $position + mb_strlen($url));
                    }
                    // 残りをエスケープして格納する。
                    $segments[] = new TextSegment($restText);
                    $segmentLines[] = $segments;
                } catch (\Exception $e) {
                    $segmentLines[] = [new TextSegment($line)]; // 例外が発生した場合は、タグ化を諦めてエスケープした文字列を表示する。
                }
            } else {
                $segmentLines[] = [new TextSegment($line)];
            }
        }
        return implode("<br>\n", array_map(function(array $segments): string {
            return implode('', array_map(function(Segment $seg): string {
                return $seg->toHtml();
            }, $segments));
        }, $segmentLines));
    }
}
