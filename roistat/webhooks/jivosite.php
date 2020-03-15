<?php

require_once __DIR__ . '/../config.php';

// ----------------------------------------------------------------------------

const JIVOSITE_EVENT_CHAT    = 'chat_finished';
const JIVOSITE_EVENT_OFFLINE = 'offline_message';

// ----------------------------------------------------------------------------

$js_data = json_decode(trim(file_get_contents('php://input')), true);
writeToLog($js_data, 'Webhook данные');

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

$roistatData = array(
    'roistat' => $visit,
    'key'     => ROISTAT_KEY,
    'title'   => $title,
    'name'    => $name,
    'phone'   => $phone,
    'email'   => $email,
    'fields'  => array(
        'CATEGORY_ID'       => getCategoryIdByDomain($domain),
        'UF_CRM_1563441838' => $form,
        'UF_CRM_1563442104' => getTypeRequestByDomain($domain),
        'UF_CRM_1563442122' => '{source}',
        'UF_CRM_1563442137' => '{utmSource}',
        'UF_CRM_1563442149' => '{utmMedium}',
        'UF_CRM_1563442163' => '{utmCampaign}',
        'UF_CRM_1563442173' => '{utmTerm}',
        'UF_CRM_1563442185' => '{utmContent}',
        'UF_CRM_1577100972693' => $domain . '.ru',
    ),
);
writeToLog($roistatData, 'Roistat данные');

// ----------------------------------------------------------------------------

switch($js_data['event_name']) {
    case JIVOSITE_EVENT_CHAT:

        foreach($js_data['chat']['messages'] as $message) {
            $name = $message['type'] == 'visitor' ? 'Пользователь' : 'Оператор';

            $messages .= $name . ': ' . $message['message'] . "\n";
        }

        $agentEmail = isset($js_data['agents'][0]['email']) ? $js_data['agents'][0]['email'] : null;

        $roistatData['comment']                  = $messages;
        $roistatData['fields']['ASSIGNED_BY_ID'] = getManagerIdByDomainAndAgentEmail($domain, $agentEmail);

        $send = file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
        writeToLog($send, 'Roistat отправка');

        break;
    case JIVOSITE_EVENT_OFFLINE:
        $roistatData['comment']                  = $js_data['message'];
        $roistatData['fields']['ASSIGNED_BY_ID'] = null;

        $send = file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
        writeToLog($send, 'Roistat отправка');

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

function getManagerIdByDomainAndAgentEmail($domain, $agentEmail)
{
    switch ($domain) {
        case 'grandvalentina':
            switch ($agentEmail) {
                case 'spir@grandvalentina.ru':   return 54; // Менеджер Отеля
                case '5zvezdanapa.ru@gmail.com': return 20; // Эльмира
                case 'askorkina85@mail.ru':      return 18; // Алена
                case 'naimanmaria@yandex.ru':    return 16; // Мария
            }
            break;
        case 'anapa-goldenbay':
            switch ($agentEmail) {
                case 'goldenbay-anapa@mail.ru': return 84; // Менеджер Отеля
                case 'info@anapa-buhta.ru':     return 20; // Эльмира
                case '773@goldenanapa.com':     return 18; // Алена
                case '772@goldenanapa.com':     return 16; // Мария
            }
            break;
        case 'apart-zolotayabuhta':
            switch ($agentEmail) {
                case 'uprav.comp@mail.ru':      return 82; // Екатерина
                case '774@goladenanapa.com':    return 20; // Эльмира
                case 'skorkin-andrey@mail.ru':  return 18; // Алена
                case 'maria09091945@yandex.ru': return 16; // Мария
            }
            break;
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