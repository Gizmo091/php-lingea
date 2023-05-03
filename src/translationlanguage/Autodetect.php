<?php

namespace Zmog\Libs\Lingea\TranslationLanguage;

use Zmog\Libs\Lingea\TranslationLanguage;

final class Autodetect extends TranslationLanguage {

    const CODE = 'xx';

    public function lingeaCode(): string {
        return self::CODE;
    }
}