<?php

namespace LapkinLab;


use Bitrix\Main\Web\Uri;

/**
 * Class Helper
 *
 * @package LapkinLab
 */
class Helper
{

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}


    /**
     * Возвращает словоформы.
     *
     * @param $word
     * @param $quantity
     *
     * @return array|bool
     */
    public static function getWordForms($word, $quantity)
    {
        switch ($word) {

            case 'number':
                $forms = ['комната', 'комнаты', 'комнат'];
                break;

            default:
                $forms = false;
        }
        return $forms ? $forms[self::getPluralForm((int) $quantity)] : $forms;
    }


    /**
     * Словоформы для различных языков.
     *
     * @param $n
     * @param bool $returnFalseForUnknown
     *
     * @return bool|int
     */
    private static function getPluralForm($n, $returnFalseForUnknown = false)
    {
        $n = abs((int) $n);
        if (!defined('LANGUAGE_ID')) {
            return (false);
        }
        // info at http://docs.translatehouse.org/projects/localization-guide/en/latest/l10n/pluralforms.html?id=l10n/pluralforms
        switch (LANGUAGE_ID) {
            case 'de':
            case 'en':
                $plural = (int) ($n !== 1);
                break;
            case 'ru':
            case 'ua':
                $plural = ((($n % 10 === 1) && ($n % 100 !== 11)) ? 0 : ((($n % 10 >= 2) && ($n % 10 <= 4) && (($n % 100 < 10) || ($n % 100 >= 20))) ? 1 : 2));
                break;
            default:
                if ($returnFalseForUnknown) {
                    $plural = false;
                }
                else {
                    $plural = (int) ($n !== 1);
                }
                break;
        }
        return ($plural);
    }

    /**
     * Форматтер цены товара.
     *
     * @param $price
     *
     * @return string
     */
    public static function priceFormat($price) {
        return number_format((float) $price, 0, ',', ' ');
    }

    /**
     * Обрезка строки (мультибайтовая).
     *
     * @param $str
     * @param $length
     * @param string $postfix
     * @param string $encoding
     *
     * @return string
     */
    public static function mbCutString(string $str, int $length = 100, $postfix = '...', $encoding = 'UTF-8') {
        if (mb_strlen($str, $encoding) <= $length) {
            return $str;
        }
        $tmp = mb_substr($str, 0, $length, $encoding);
        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
    }

    /**
     * Add get parameters to url
     *
     * @param string $url
     * @param array $params
     *
     * @return mixed
     */
    public static function addGetParameters(string $url, array $params)
    {
        $uri = new Uri($url);
        $uri->addParams($params);
        return $uri->getUri();
    }

}
