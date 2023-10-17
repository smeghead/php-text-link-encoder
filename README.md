# php-text-link-encoder

A library that converts any string containing URLs and Emails (such as a user-entered string) into a html string containing url link. Non-URL parts are html-encoded.

![Testing](https://github.com/smeghead/php-text-link-encoder/actions/workflows/php.yml/badge.svg?event=push) [![Latest Stable Version](http://poser.pugx.org/smeghead/text-link-encoder/v)](https://packagist.org/packages/smeghead/text-link-encoder) [![Total Downloads](http://poser.pugx.org/smeghead/text-link-encoder/downloads)](https://packagist.org/packages/smeghead/text-link-encoder) [![Latest Unstable Version](http://poser.pugx.org/smeghead/text-link-encoder/v/unstable)](https://packagist.org/packages/smeghead/text-link-encoder) [![License](http://poser.pugx.org/smeghead/text-link-encoder/license)](https://packagist.org/packages/smeghead/text-link-encoder) [![PHP Version Require](http://poser.pugx.org/smeghead/text-link-encoder/require/php)](https://packagist.org/packages/smeghead/text-link-encoder)

## Features

 * Converts urls and Emails in text to link tags.
 * Other parts are properly encoded.

## Install

### From Composer

```bash
$ composer require smeghead/text-link-encoder
```

## Usage

```php
<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Smeghead\TextLinkEncoder\TextLinkEncoder;
use Smeghead\TextLinkEncoder\Config\Settings;

$encoder = new TextLinkEncoder(new Settings());
echo $encoder->encode('Web Site: http://www.example.com/');
// -> Web Site: <a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>

echo $encoder->encode('Email: info@example.com');
// -> Email: <a href="mailto:info@example.com" target="_blank" rel="noopener">info@example.com</a>

echo $encoder->encode('<script>alert(1);</script> http://www.example.com/');
// -> &lt;script&gt;alert(1);&lt;/script&gt; <a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>
```

Settings

```php
<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Smeghead\TextLinkEncoder\TextLinkEncoder;
use Smeghead\TextLinkEncoder\Config\Settings;

$encoder = new TextLinkEncoder(
    (new Settings())
    ->linkTarget('_self')
    ->convertNewLineToBrTag(false)
);
echo $encoder->encode("Web Site: http://www.example.com/\nDescription: ...");
// -> Web Site: <a href="http://www.example.com/" target="_self" rel="noopener">http://www.example.com/</a>
//    Description: ...
```

## Development

### Open shell

```bash
docker compose build
docker compose run php_cli bash
```

### install dependencies

```bash
composer install
```

### execute tests

```bash
composer test
```

## CONTRIBUTING

Both Issues and Pull Requests are welcome!
