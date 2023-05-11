<?php

include dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
if ($argc <= 1) {
    echo "Usage: php language.php <api_key>".PHP_EOL;
    exit(1);
}
$api_key = $argv[1];

$TranslationApi = new \Zmog\Libs\Lingea\TranslationApi($api_key);
$From_lng = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode('fre');
$text = 'Bonjour, je suis Mathieu, le developpeur qui à créé ce repo.';
$Format = \Zmog\Libs\Lingea\TranslationFormat\Plain::instance();
$To_lng = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode('eng');
$translated_text = $TranslationApi->translate($text,$From_lng,$To_lng,$Format);
echo $translated_text.PHP_EOL;
$To_lng = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode('rus');
$translated_text = $TranslationApi->translate($text,$From_lng,$To_lng,$Format);
echo $translated_text.PHP_EOL;
$To_lng = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1::fromCode('cs');
$translated_text = $TranslationApi->translate($text,$From_lng,$To_lng,$Format);
echo $translated_text.PHP_EOL;
