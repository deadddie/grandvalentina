<?php

// http://grandvalentina.ru/roistat/webhooks/calltracking.php

// Константы Bitrix24.
const BITRIX_USER_ID    = '132';
const BITRIX_SECRET_KEY = '27xsz2tl3r0662xw';
const BITRIX_SUBDOMAIN  = 'goldenbay';

// Webhook данные
$data = json_decode(trim(file_get_contents('php://input')), true);
writeToLog($data, 'Webhook данные');

if(empty($data)) {
    die('NO data');
}

// Необходимые данные
$visit = !empty($data['visit_id']) ? $data['visit_id'] : $data['marker'];
$phone = $data['caller'];

// Ждем CRM
sleep(5);

// Поиск сделок
$searchDeals = crmLeadPeriod();
writeToLog($searchDeals, 'Поиск сделок');

// Поиск лида по телефона
$searchDeal = array_shift(array_filter($searchDeals, function($item) use ($phone) {
    return (preg_replace('/\D/', '', $item['TITLE']) == $phone);
}));

// Проверка поиска сделки
if(empty($searchDeal)) {
    die('No deal');
}

// Проверка наличия номера визита
if(!empty($searchDeal['UF_CRM_1563441827'])) {
    die('Exist visit');
}

writeToLog($searchDeal, 'Сделка');

// Обновление
$update = crmDealUpdate($searchDeal['ID'], $visit, $data['utm_source'], $data['utm_medium'], $data['utm_campaign'], $data['utm_term'], $data['utm_content']);
writeToLog(array('update' => $update), 'Обновление');

// ----------------------------------------------------------------------------

//Функция обноления номера визита у лида в Bitrix24 по ID лида
function crmDealUpdate($orderId, $visit, $source, $medium, $campaign, $term, $content) {
    $queryUrl = 'https://' . BITRIX_SUBDOMAIN . '.bitrix24.ru/rest/' . BITRIX_USER_ID . '/' . BITRIX_SECRET_KEY . '/crm.deal.update';
    $queryData = http_build_query(array(
        'id' => $orderId,
        'fields' => array(
            'UF_CRM_1563441827' => $visit,    // roistat
            'UF_CRM_1563442137' => $source,   // Рекламная система
            'UF_CRM_1563442149' => $medium,   // Тип трафика
            'UF_CRM_1563442163' => $campaign, // Рекламная кампания
            'UF_CRM_1563442173' => $term,     // Ключевое слово
            'UF_CRM_1563442185' => $content,  // Информация, которая помогает различать объявления
        )
    ));

    return curlSendBitrix($queryUrl, $queryData);
}

// Функция получения лида в Bitrix24 по ID
function crmLeadPeriod() {
    $back = new DateTime(date('Y-m-d H:i:s'));

    $queryUrl = 'https://' . BITRIX_SUBDOMAIN . '.bitrix24.ru/rest/' . BITRIX_USER_ID . '/' . BITRIX_SECRET_KEY . '/crm.deal.list';
    $queryData = http_build_query(array(
        'order' => array('DATE_CREATE' => 'DESC'),
        'filter' => array(
            '>DATE_CREATE' => $back->modify('-340 MINUTES')->format('Y-m-d H:i:s'),
        ),
        'select' => ['ID', 'TITLE', 'PHONE', 'UF_CRM_1505202807'],
    ));

    return curlSendBitrix($queryUrl, $queryData);
}

// Функция отправки CURL запроса в Bitrix24
function curlSendBitrix($url, $queryData) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $queryData,
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, true);

    if (!empty($result['result'])) {
        if (!array_key_exists('error', $result)) {
            return $result['result'];
        } else {
            writeToLog($result, "Error response!");
        }
    }
}

// Функция логирования
function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("d.m.Y G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(getcwd() . '/log_data_calltacking.log', $log, FILE_APPEND);
    return true;
}