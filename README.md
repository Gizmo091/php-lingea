# php-lingea

This repo help you to manage your Lingea api requests. 

[![GitHub release](https://img.shields.io/badge/release-v1.0.0-blue.svg)](https://github.com/Gizmo091/php-lingea/releases/)
![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue.svg)

[comment]: <> (Badge generated with https://naereen.github.io/badges/)


## Installation

```bash
composer require zmog/php-lingea
```

## Usage

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$api_key = 'you_api_key';

$TranslationApi = new \Zmog\Libs\Lingea\TranslationApi($api_key);
$text = 'Hello, my name is Mathieu.';

$translated_text = $TranslationApi->translate($text,\Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode('eng'),\Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1::fromCode('cs'),\Zmog\Libs\Lingea\TranslationFormat\Plain::instance());
?>
```


## Demo scripts :

```
php test/language.php "my_api_key"
php test/translate.php "my_api_key"
```

