<?php

declare(strict_types=1);

namespace Smeghead\TextLinkEncoder;

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
        $outputLines = [];
        foreach ($lines as $line) {
            if (preg_match_all('/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/', $line, $matches)) {
                try {
                    $restText = $line;
                    $parts = [];
                    foreach ($matches[0] as $url) {
                        $position = mb_strpos($restText, $url);
                        if ($position === false) {
                            throw new \Exception('failed to search url string.');
                        }
                        // URLより前の部分をエスケープしてpartsに格納する。
                        $parts[] = htmlspecialchars(mb_substr($restText, 0, $position), ENT_QUOTES);
                        // URLをリンクに変換する。
                        $parts[] = sprintf(
                            '<a href="%s" target="_blank" rel="noopener">%s</a>',
                            htmlspecialchars($url, ENT_QUOTES),
                            htmlspecialchars($url, ENT_QUOTES)
                        );
                        $restText = mb_substr($restText, $position + mb_strlen($url));
                    }
                    // 残りをエスケープして格納する。
                    $parts[] = htmlspecialchars($restText, ENT_QUOTES);
                    $outputLines[] = implode('', $parts);
                } catch (\Exception $e) {
                    $outputLines[] = htmlspecialchars($line, ENT_QUOTES); // 例外が発生した場合は、タグ化を諦めてエスケープした文字列を表示する。
                }
            } else {
                $outputLines[] = htmlspecialchars($line, ENT_QUOTES);
            }
        }
        return implode("<br>\n", $outputLines);
    }
}
