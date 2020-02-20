<?php

use LapkinLab\Core;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Контакты');
$APPLICATION->SetTitle('Контакты');

$points = array(
    0 => array(
        'title' => SITE_CONFIG['name_short'],
        'lat' => SITE_CONFIG['gps']['lat'],
        'lon' => SITE_CONFIG['gps']['lon'],
    ),
);
?>
<div class="page-contacts">
    <div class="container">
        <div class="row">
            <h1 class="page-title col-12 text-center"><?= $APPLICATION->GetTitle() ?></h1>
            <div class="col-12">

                <div class="page-contacts--section">
                    <h2>Адрес</h2>
                    <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                    <p><?= SITE_CONFIG['address_full'] ?></p>
                </div>

                <div class="page-contacts--section">
                    <h2>Ресепшен</h2>
                    <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                    <p><?= Core::parsePhone(SITE_CONFIG['phone'], 'link') ?></p>
                    <p><?= Core::renderEmail(SITE_CONFIG['email']) ?></p>
                </div>

                <div class="page-contacts--section">
                    <h2>Отдел бронирования</h2>
                    <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                    <p><?= Core::parsePhone(SITE_CONFIG['phones']['booking'], 'link') ?></p>
                </div>

                <div class="page-contacts--section">
                    <h2>Ресторан</h2>
                    <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                    <p><?= Core::parsePhone(SITE_CONFIG['phones']['restaurant'], 'link') ?></p>
                </div>

                <div class="page-contacts--section">
                    <h2>Удаленность</h2>
                    <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                    <p class="h4">Расположенный в самом центре Grand Hotel Valentina гарантирует своим гостям удобный доступ к развитой транспортной инфраструктуре:</p>
                    <ul>
                        <li><b>Аэропорт Витязево – 16 км.</b></li>
                        <li><b>Железнодорожный Вокзал – 12 км</b></li>
                        <li><b>Автовокзал – 1,5 км</b></li>
                        <li><b>Морской Вокзал – 2 км</b></li>
                    </ul>
                </div>

                <div class="page-contacts--section">
                    <h3>Отель находится в шаговой доступности от следующих объектов инфраструктуры Анапы:</h3>
                    <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                    <ul>
                        <li>Городской песчаный пляж</li>
                        <li>Центральная набережная</li>
                        <li>Администрация города</li>
                        <li>Парк аттракционов</li>
                        <li>Памятник османской военной Архитектуры XVIII века – «Русские ворота»</li>
                    </ul>
                </div>

            </div>

            <div class="page-contacts--section--order">
                <?= view('forms.event_order', [
                    'APPLICATION' => $APPLICATION,
                    'id' => 'contacts-order'
                ], false) ?>
            </div>

            <div class="col-12">
                <div class="page-contacts--section page-contacts--section--map">
                    <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/map.php', array('points' => $points)) ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?>
