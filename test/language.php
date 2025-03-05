<?php
include dirname( __DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

use Zmog\Libs\Lingea\TranslationApi;
use Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1;
use Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b;
use Zmog\Libs\Lingea\TranslationLanguage\Name;

if ($argc <= 1) {
    echo "Usage: php language.php <api_key>".PHP_EOL;
    exit(1);
}
$api_key = $argv[1];

$iso_639_2b = ISO_639_2b::fromCode('fre');
echo "From \"fre\" ISO_639_2b code to linguea code ".$iso_639_2b->lingeaCode().PHP_EOL;
// echo "fr"

$iso_639_1 = ISO_639_1::fromCode('fr');
echo "From \"fr\" ISO_639_1 code to linguea code ". $iso_639_1->lingeaCode().PHP_EOL;
// echo "fr"

$name = Name::fromCode('french');
echo "From \"french\" name code to linguea code ". $name->lingeaCode().PHP_EOL;
// echo "fr"


$TranslationApi = new TranslationApi($api_key);
$Pairs          = $TranslationApi->getTranslationPairs();
foreach($Pairs as $Pair) {
    echo $Pair->getFrom()->name().' -> '.$Pair->getTo()->name().PHP_EOL;
}