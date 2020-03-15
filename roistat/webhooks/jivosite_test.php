<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use Roistat\Proxylead\Integration as Proxylead;

// ----------------------------------------------------------------------------

const FILE_KEY = '1d3c5807995c80eeebdde68f8b2b85ee';
const JIVOSITE_EVENT_CHAT    = 'chat_finished';
const JIVOSITE_EVENT_OFFLINE = 'offline_message';

if($_GET['key'] != FILE_KEY) {
    die('Key invalid');
}

// ----------------------------------------------------------------------------

if($_GET['key'] != FILE_KEY) {
    die('Invalid key');
}

$data = json_decode(trim(file_get_contents('php://input')), true);
writeToLog($data, 'Webhook данные');

if(empty($js_data)) {
    die('{"starus": "error", "message": "data_empty"}');
}

// Необходимые данные
$visit   = isset($js_data['user_token'])       ? $js_data['user_token']       : 'nocookie';
$form    = 'JivoSite';
$title   = 'Заявка с "JivoSite"';
$name    = isset($js_data['visitor']['name'])  ? $js_data['visitor']['name']  : null;
$phone   = isset($js_data['visitor']['phone']) ? $js_data['visitor']['phone'] : null;
$email   = isset($js_data['visitor']['email']) ? $js_data['visitor']['email'] : null;
$domain  = isset($_GET['domain'])              ? $_GET['domain']              : $_GET['domain'];
$comment = null;

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
];

$fields = [
    'roistat' => $visit,
    'title'   => $title,
    'name'    => $name,
    'phone'   => $phone,
    'email'   => $email,
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
];

$proxylead = new Proxylead(ROISTAT_KEY, Proxylead::BITRIX);

$proxylead->aliases($aliases);
$proxylead->fields($fields);
$proxylead->additionalFields($additionalFields);

// ----------------------------------------------------------------------------

switch($js_data['event_name']) {
    case JIVOSITE_EVENT_CHAT:

        foreach($js_data['chat']['messages'] as $message) {
            $name = $message['type'] == 'visitor' ? 'Пользователь' : 'Оператор';

            $messages .= $name . ': ' . $message['message'] . "\n";
        }

        $fields['comment'] = $messages;

        $proxylead->createRequest();

        break;
    case JIVOSITE_EVENT_OFFLINE:
        $fields['comment'] = $js_data['message'];

        $proxylead->createRequest();

        break;
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
    file_put_contents(getcwd() . '/log_data_jivosite.log', $log, FILE_APPEND);
    return true;
}