<?php

include "../vendor/autoload.php";
if ($argc <= 1) {
    echo "Usage: php language.php <api_key>".PHP_EOL;
    exit(1);
}
$api_key = $argv[1];

$iso_639_2b = new \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b('fre');
echo $iso_639_2b->lingeaCode().PHP_EOL;
// echo "fr"

$iso_639_1 = new \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1('fr');
echo $iso_639_1->lingeaCode().PHP_EOL;
// echo "fr"

$name = new \Zmog\Libs\Lingea\TranslationLanguage\Name('french');
echo $name->lingeaCode().PHP_EOL;
// echo "fr"


$TranslationApi = new \Zmog\Libs\Lingea\TranslationApi($api_key);
$Pairs = $TranslationApi->getTranslationPairs();
