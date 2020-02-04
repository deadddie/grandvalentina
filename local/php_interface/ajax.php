<?php

/**
 * Ajax Handler
 *
 * Все ajax-запросы должны идти через это обработчик.
 *
 * @author deadie (https://deadie.ru)
 */

use LapkinLab\Ajax;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (isset($_POST) && !empty($_POST['action'])) {
    $post = $_POST;
    $method = $post['action'];
    $result = (method_exists(Ajax::class, $method))
        ? Ajax::$method($post)
        : Ajax::responseOnly(405); // результат из метода, иначе 405 Method Not Allowed
    http_response_code($result['response']['code']);
    print json_encode($result);
} else {
    http_response_code(500);
    print json_encode(Ajax::responseOnly(500)); // ошибка сервера (пустой POST)
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
