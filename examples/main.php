<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Smeghead\TextLinkEncoder\TextLinkEncoder;

$encoder = new TextLinkEncoder('Web Site: http://www.example.com/');
echo $encoder->encode();
