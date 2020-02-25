<?php


namespace LapkinLab;

/**
 * Trait ResponseTrait
 *
 * @package LapkinLab
 */
trait ResponseTrait
{

    /**
     * Коды ошибок.
     *
     * @var array HTTP Responses.
     */
    public static $http_codes = array(
        200 => '200 OK',
        304 => '304 Not Modified',
        400 => '400 Bad Request',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        500 => '500 Internal Server Error',
        503 => '503 Service Unavailable',
    );

    /**
     * Установка названия метода в ответ (инициализация).
     *
     * @param $function_name
     *
     * @return array
     */
    protected static function initialize(string $function_name): array
    {
        return array(
            'method' => $function_name,
        );
    }

    /**
     * Установка параметров ответа.
     *
     * @param $response
     * @param $code
     * @return mixed
     */
    protected static function setCode(&$response, $code)
    {
        $response['response'] = array(
            'code' => $code,
            'message' => self::$http_codes[$code]
        );
        return $response;
    }

    /**
     * Возврат только ответа.
     *
     * @param $code
     * @return mixed
     */
    public static function setCodeOnly($code)
    {
        $response['response'] = array(
            'code' => $code,
            'message' => self::$http_codes[$code]
        );
        return $response;
    }

}
