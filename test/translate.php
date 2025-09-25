<?php
include dirname( __DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

use Zmog\Libs\Lingea\TranslationApi;
use Zmog\Libs\Lingea\TranslationFormat\Plain;
use Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1;
use Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b;

if ($argc <= 1) {
    echo "Usage: php language.php <api_key> (<api_url>?)".PHP_EOL;
    exit(1);
}
$api_key = $argv[1];
$api_url = null;
if ($argc >= 3) {
    if (filter_var($argv[2], FILTER_VALIDATE_URL)) {
        $api_url = $argv[2];
    } else {
        echo "Error: Invalid URL provided: {$argv[2]}" . PHP_EOL;
        echo "Please provide a valid URL as the second argument" . PHP_EOL;
        exit( 1 );
    }
}

$TranslationApi = new TranslationApi($api_key,$api_url);
$From_lng = ISO_639_2b::fromCode('fre');
$text = 'Bonjour, je suis Mathieu, le developpeur qui à créé ce repo.';
$Format = Plain::instance();
$To_lng = ISO_639_2b::fromCode('eng');
$translated_text = $TranslationApi->translate($text,$From_lng,$To_lng,$Format);
echo $translated_text.PHP_EOL;
$To_lng = ISO_639_2b::fromCode('rus');
$translated_text = $TranslationApi->translate($text,$From_lng,$To_lng,$Format);
echo $translated_text.PHP_EOL;
$To_lng = ISO_639_1::fromCode('cs');
$translated_text = $TranslationApi->translate($text,$From_lng,$To_lng,$Format);
echo $translated_text.PHP_EOL;
