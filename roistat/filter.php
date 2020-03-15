<?php

// http://grandvalentina.ru/roistat/filter.php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Roistat\Proxylead\Integration as Proxylead;

// ----------------------------------------------------------------------------

const FILE_KEY = '1d3c5807995c80eeebdde68f8b2b85ee';

// ----------------------------------------------------------------------------

if($_GET['key'] != FILE_KEY) {
    die('Invalid key');
}

$data = $_GET;
writeToLog($data, 'Webhook данные');

$visit   = isset($data['visit'])   ? $data['visit']   : 'nocookie';
$form    = isset($data['form'])    ? $data['form']    : null;
$title   = isset($data['title'])   ? $data['title']   : null;
$name    = isset($data['name'])    ? $data['name']    : null;
$phone   = isset($data['phone'])   ? $data['phone']   : null;
$email   = isset($data['email'])   ? $data['email']   : null;
$comment = isset($data['comment']) ? $data['comment'] : null;
$domain  = isset($data['domain'])  ? $data['domain']  : null;

$price         = isset($data['price'])         ? $data['price']         : null;
$arrivalDate   = isset($data['arrivalDate'])   ? $data['arrivalDate']   : null;
$departureDate = isset($data['departureDate']) ? $data['departureDate'] : null;
$roomsName     = isset($data['roomsName'])     ? $data['roomsName']     : null;
$rooms         = isset($data['rooms'])         ? $data['rooms']         : null;
$hotel         = isset($data['hotel'])         ? $data['hotel']         : null;
$guests        = isset($data['guests'])        ? $data['guests']        : null;
$rate          = isset($data['rate'])          ? $data['rate']          : null;

// ----------------------------------------------------------------------------

$aliases = [
    'typeTreatment' => 'UF_CRM_1563441838', // Тип обращения
    'typeRequest'   => 'UF_CRM_1563442104', // Тип заявки
    'source'        => 'UF_CRM_1563442122', // Источник (Маркер)
    'utmSource'     => 'UF_CRM_1563442137', // Рекламная система
    'utmMedium'     => 'UF_CRM_1563442149', // Тип трафика
    'utmCampaign'   => 'UF_CRM_1563442163', // Рекламная кампания
    'utmTerm'       => 'UF_CRM_1563442173', // Ключевое слово
    'utmContent'    => 'UF_CRM_1563442185', // Информация, которая помогает различать объявления

    'price'         => 'OPPORTUNITY',       // Стоимость
    'arrivalDate'   => 'UF_CRM_1561728910', // Дата заезда
    'departureDate' => 'UF_CRM_1561728928', // Дата выезда
    'roomsName'     => 'UF_CRM_1561728934', // Категория номера
    'rooms'         => 'UF_CRM_1561728948', // Кол-во номеров
    'hotel'         => 'UF_CRM_1561456180', // Отель
    'guests'        => 'UF_CRM_1566310390', // Количество гостей
    'rate'          => 'UF_CRM_1566310047', // Тариф
    'site'          => 'UF_CRM_1577100972693', // Сайт
];

$fields = [
    'roistat' => $visit,
    'title'   => $title,
    'name'    => $name,
    'phone'   => $phone,
    'email'   => $email,
    'comment' => $comment,
];

$additionalFields = [
    'CATEGORY_ID'   => getCategoryIdByDomain($domain),
    'typeTreatment' => $form,
    'typeRequest'   => getTypeRequestByDomain($domain),
    'source'        => '{source}',
    'utmSource'     => '{utmSource}',
    'utmMedium'     => '{utmMedium}',
    'utmCampaign'   => '{utmCampaign}',
    'utmTerm'       => '{utmTerm}',
    'utmContent'    => '{utmContent}',

    'price'         => $price,
    'arrivalDate'   => $arrivalDate,
    'departureDate' => $departureDate,
    'roomsName'     => $roomsName,
    'rooms'         => $rooms,
    'hotel'         => $hotel,
    'guests'        => $guests,
    'rate'          => $rate,
    'site'          => $domain . '.ru',
];

// ----------------------------------------------------------------------------

$proxylead = new Proxylead(ROISTAT_KEY, Proxylead::BITRIX);

$proxylead->aliases($aliases);
$proxylead->fields($fields);
$proxylead->additionalFields($additionalFields);

// Антиспам
if($visit != 'nocookie') {
    $proxylead->createRequest();
}

// ----------------------------------------------------------------------------

function getTypeRequestByDomain($domain)
{
    switch ($domain) {
        case 'grandvalentina':
        case 'anapa-goldenbay':
        case 'apart-zolotayabuhta':
        case 'anapa-zarya':
            return 'Отели';
        case 'alibaba-anapa':
        case 'kovcheg-anapa':
        case 'mabiclub':
        case 'anapa-goodeat':
            return 'Общепит';
        case 'anapa-akvapark':
        case 'akvapark-nebug':
        case 'akvapark-tikitak':
        case 'olympia-anapa':
            return 'Аквапарки';
        case 'mirkinoanapa':
            return 'Кинотеатр';
    }

    return null;
}

function getCategoryIdByDomain($domain)
{
    switch ($domain) {
        case 'grandvalentina':
        case 'anapa-goldenbay':
        case 'apart-zolotayabuhta':
        case 'anapa-zarya':
            return '0';
        case 'alibaba-anapa':
        case 'kovcheg-anapa':
        case 'mabiclub':
        case 'anapa-goodeat':
            return '2';
        case 'anapa-akvapark':
        case 'akvapark-nebug':
        case 'akvapark-tikitak':
        case 'olympia-anapa':
            return '4';
        case 'mirkinoanapa':
            return '6';
    }

    return null;
}

// ----------------------------------------------------------------------------

function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("d.m.Y G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(getcwd() . '/log_data_filter.log', $log, FILE_APPEND);
    return true;
}