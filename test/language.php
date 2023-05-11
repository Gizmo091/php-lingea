<?php

include dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
if ($argc <= 1) {
    echo "Usage: php language.php <api_key>".PHP_EOL;
    exit(1);
}
$api_key = $argv[1];

$iso_639_2b = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode('fre');
echo $iso_639_2b->lingeaCode().PHP_EOL;
// echo "fr"

$iso_639_1 = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1::fromCode('fr');
echo $iso_639_1->lingeaCode().PHP_EOL;
// echo "fr"

$name = \Zmog\Libs\Lingea\TranslationLanguage\Name::fromCode('french');
echo $name->lingeaCode().PHP_EOL;
// echo "fr"


$TranslationApi = new \Zmog\Libs\Lingea\TranslationApi($api_key);
$Pairs          = $TranslationApi->getTranslationPairs();
foreach($Pairs as $Pair) {
    echo $Pair->getFrom()->name().' -> '.$Pair->getTo()->name().PHP_EOL;
}