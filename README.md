# php-text-link-encoder

A library that converts any string containing a URL (such as a user-entered string) into a html string containing url link. Non-URL parts are html-encoded.

![Testing](https://github.com/smeghead/php-text-link-encoder/actions/workflows/php.yml/badge.svg?event=push) [![Latest Stable Version](http://poser.pugx.org/smeghead/text-link-encoder/v)](https://packagist.org/packages/smeghead/text-link-encoder) [![Total Downloads](http://poser.pugx.org/smeghead/text-link-encoder/downloads)](https://packagist.org/packages/smeghead/text-link-encoder) [![Latest Unstable Version](http://poser.pugx.org/smeghead/text-link-encoder/v/unstable)](https://packagist.org/packages/smeghead/text-link-encoder) [![License](http://poser.pugx.org/smeghead/text-link-encoder/license)](https://packagist.org/packages/smeghead/text-link-encoder) [![PHP Version Require](http://poser.pugx.org/smeghead/text-link-encoder/require/php)](https://packagist.org/packages/smeghead/text-link-encoder)

## Features

 * Converts urls in text to link tags.
 * Other parts are properly encoded.

## Install

### From Composer

```bash
$ composer require smeghead/text-link-encoder
```

## Usage

```
<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Smeghead\TextLinkEncoder\TextLinkEncoder;

$encoder = new TextLinkEncoder('Web Site: http://www.example.com/');
echo $encoder->encode();
// -> Web Site: <a href="http://www.example.com/" target="_blank" rel="noopener">http://www.example.com/</a>
```

## Development

### Open shell

```bash
docker compose build
docker compose run --rm php_cli bash
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
