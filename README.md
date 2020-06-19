# OG:READER

[![GitHub release](https://img.shields.io/github/release/attus74/og_reader.svg)](https://GitHub.com/attus74/og_reader/releases/)

An easy to use OG:Property Parser

```
use Attus\OgReader\Reader;

$reader = new Reader($url);
$reader->read();
$imageUrl = $reader->getValue('image');
```