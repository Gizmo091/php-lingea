<?php

include dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
if ($argc <= 1) {
    echo "Usage: php language.php <api_key>".PHP_EOL;
    exit(1);
}
$api_key = $argv[1];


$bench = function(callable $callable,string $label, int $iteration = 1) {
    $i = $iteration;
    $durations = 0;
    while($i-- > 0) {
        $start = microtime(true);
        $callable();
        $end      = microtime(true);
        $duration = $end - $start;
        echo $label.' took '.$duration." seconds".PHP_EOL;
        $durations+= $duration;
    }
    echo "=> Average for $iteration iterations of $label : ".($durations/$iteration)." seconds ".PHP_EOL;
};


$bench_fn = function(string $language_code) use ($api_key) {
    $From_lng = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode("fre");
    $TranslationApi = new \Zmog\Libs\Lingea\TranslationApi($api_key);
    $Format = \Zmog\Libs\Lingea\TranslationFormat\Plain::instance();
    $To_lng = \Zmog\Libs\Lingea\TranslationLanguage\ISO_639_2b::fromCode($language_code);
    return function() use ($TranslationApi,$From_lng,$To_lng,$Format) {
        $TranslationApi->translate('Bonjour, je suis Mathieu, le developpeur qui à créé ce repo.',$From_lng,$To_lng,$Format);
    };
};

foreach (['eng','rus','ara','hun','ita','pol','por','spa','tur','ukr'] as $lng_code) {
    $bench($bench_fn($lng_code),"Translate To $lng_code",2);
}
