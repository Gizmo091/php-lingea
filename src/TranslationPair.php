<?php

namespace Zmog\Libs\Lingea;

class TranslationPair {

    protected TranslationLanguage $_FromLanguage;
    protected TranslationLanguage $_ToLanguage;

    public function __construct(TranslationLanguage $FromLanguage, TranslationLanguage $ToLanguage) {
        $this->_FromLanguage = $FromLanguage;
        $this->_ToLanguage   = $ToLanguage;
    }

}