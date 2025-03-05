<?php

namespace Zmog\Libs\Lingea;

use ReflectionClass;

abstract class TranslationFormat {

    final private function __construct() {}

    final public function format(): string {
        return lcfirst((new ReflectionClass($this))->getShortName());
    }

    protected static ?TranslationFormat $_instance = null;
    final public static function instance(): ?TranslationFormat {
        if (static::$_instance === null) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }
}