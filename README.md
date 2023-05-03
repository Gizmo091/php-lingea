# php-lingea

This repo help you to manage your Lingea api call. 

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

