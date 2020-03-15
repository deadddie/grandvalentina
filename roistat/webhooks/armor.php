<?php

// Данные
$data = $_GET;
writeToLog($data, 'Данные');

// Необходимые данные
$name    = $data['roomTypes'][0]['guests'][0]['name'];
$phone   = $data['customerPhone']['country']['phoneCode'].$data['customerPhone']['phone'];
$email   = $data['customerEmail'];
$comment = $data['customerComment'];
$price   = $data['price'];

//
$arrivalDate   = $data['arrivalDate'];
$departureDate = $data['departureDate'];
$rooms         = $data['rooms'];
$guests        = $data['guests'];
$prepayment    = $data['prepayment'];
$roomsName     = '';
foreach ($data['roomTypes'] as $room) {
    $roomsName .= $room['name'] . ' ';
}
$rate          = '';
foreach ($data['roomTypes'] as $rateName) {
    $rate .= $rateName['rateName'] . "\n";
}

// Собранные данные
$filterData = [
    'key'     => '1d3c5807995c80eeebdde68f8b2b85ee',
    'visit'   => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
    'form'    => 'Бронирование',
    'title'   => 'Заявка с "Бронирование"',
    'name'    => $name,
    'phone'   => $phone,
    'email'   => $email,
    'comment' => $comment,
    'price'   => $price,

    'arrivalDate'   => $arrivalDate,
    'departureDate' => $departureDate,
    'roomsName'     => $roomsName,
    'rooms'         => $rooms,
    'hotel'         => 48,
    'guests'        => $guests,
    'rate'          => $rate,
    'prepayment'    => $prepayment,

    'domain'  => 'grandvalentina',
];
writeToLog($filterData, 'Собранные данные');

// Отправка
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://grandvalentina.ru/roistat/filter.php?' . http_build_query($filterData));
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
$out = curl_exec($curl);
curl_close($curl);

// ----------------------------------------------------------------------------

function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("d.m.Y G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(getcwd() . '/log_data_travelline.log', $log, FILE_APPEND);
    return true;
}