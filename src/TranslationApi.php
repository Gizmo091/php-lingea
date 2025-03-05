<?php

namespace Zmog\Libs\Lingea;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class TranslationApi {

    protected string $_api_key;
    protected string $_api_url;


    public function __construct(string $api_key, string $api_url = 'https://api1.lingea.com/translate.1.3.1/') {
        $this->_api_key = $api_key;
        $this->_api_url = $api_url;
    }


    /**
     * @return \Zmog\Libs\Lingea\TranslationPair[]
     * @throws \Zmog\Libs\Lingea\LingeaException
     */
    public function getTranslationPairs(): array {
        $Request = new Request('GET', $this->_api_url.'?'.http_build_query([
                                                                               'apiKey'      => $this->_api_key,
                                                                               'langStd'     => 'iso2',
                                                                               'langSupport' => 'directions',
                                                                               'locLang'     => 'en',
                                                                           ]));
        $Client  = new Client([]);
        try {
            $Response = $Client->send($Request);
        }
        catch (GuzzleException $e) {
            throw new LingeaException('Error during translation pair retrieval.', 0, $e);
        }
        $body                 = (string)$Response->getBody();
        $language_pairs       = json_decode($body, true);
        $supported_language_a = [];
        foreach ($language_pairs as $pair) {
            $supported_language_a[] = new TranslationPair(TranslationLanguage::fromLingeaCode($pair['srcId']), TranslationLanguage::fromLingeaCode($pair['tgtId']));
        }
        return $supported_language_a;
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Zmog\Libs\Lingea\LingeaException
     */
    public function translate(string $text, TranslationLanguage $from_lng, TranslationLanguage $to_lng, TranslationFormat $from_format, ?TranslationFormat $to_format = null): string {
        $to_format = $to_format ?? $from_format;
        $Client    = new Client([]);

        try {
            $Response = $Client->request('POST', $this->_api_url, [
                'form_params' => [
                    'apiKey'     => $this->_api_key,
                    'langStd'    => 'iso2',
                    'toFormat'   => $to_format->format(),
                    'fromFormat' => $from_format->format(),
                    'fromLang'   => $from_lng->lingeaCode(),
                    'toLang'     => $to_lng->lingeaCode(),
                    'text'       => $text,
                ]
            ]);
        }
        catch ( Exception $e) {
            throw new LingeaException('Error '.$e->getMessage(), 0, $e);
        }

        if ($Response->getStatusCode() !== 200) {
            throw new LingeaException('Error '.$Response->getStatusCode().' : '.$Response->getReasonPhrase());
        }
        return (string)$Response->getBody();
    }

}