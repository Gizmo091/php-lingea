<?php

namespace Zmog\Libs\Lingea;


use WhiteCube\Lingua\Service;
use Zmog\Libs\Lingea\TranslationLanguage\Autodetect;
use Zmog\Libs\Lingea\TranslationLanguage\ISO_639_1;

abstract class TranslationLanguage {

    protected string $_language_code;

    /**
     * @var \WhiteCube\Lingua\Service $_Service
     */
    protected Service $_Service;
    public final function __construct(string $language_code) {
        $this->_language_code = $language_code;
        $this->_Service = call_user_func_array([
                                                   Service::class,
                                                   'createFrom'.(new \ReflectionClass($this))->getShortName(),
                                               ], [$this->_language_code]);
        if("" === $this->_Service->toISO_639_1()) {
            throw new LingeaException('Language code "'.$this->_language_code.'" is not a valid code.');
        }
    }

    public static function fromCode(string $language_code): TranslationLanguage {
        return new static($language_code);
    }

    protected ?string $_lingea_code = null;

    public function lingeaCode(): string {
        if (null === $this->_lingea_code) {
            $this->_lingea_code = $this->_Service->toISO_639_1();
        }
        return $this->_lingea_code;
    }

    public static function fromLingeaCode(string $language_code): TranslationLanguage {
        $language_code = strtolower($language_code);
        if (Autodetect::CODE === $language_code) {
            return new Autodetect(Autodetect::CODE);
        }
        return new ISO_639_1($language_code);
    }

}