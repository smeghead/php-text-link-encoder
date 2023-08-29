<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Smeghead\TextLinkEncoder\TextLinkEncoder;

$encoder = new TextLinkEncoder();
echo $encoder->encode('Web Site: http://www.example.com/');
echo "\n";
echo $encoder->encode('Email: info@example.com');
echo "\n";
echo $encoder->encode('<script>alert(1);</script> http://www.example.com/');
