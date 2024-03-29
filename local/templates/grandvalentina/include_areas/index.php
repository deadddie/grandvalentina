<?php

use LapkinLab\Core;
use LapkinLab\Content\{Offers, Rooms};
use Bitrix\Main\Localization\Loc;

$points = array(
    0 => array(
        'title' => SITE_CONFIG['name_short'],
        'lat' => SITE_CONFIG['gps']['lat'],
        'lon' => SITE_CONFIG['gps']['lon'],
    ),
);
?>
<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/front_screen.php') ?>

<?= Offers::getList('block') ?>
<?= Rooms::getList('block') ?>

<!--услуги-->
<div class="index-services">
    <div class="index-services--wrapper">

        <h2 class="index-services--title"><?= Loc::getMessage('Services') ?></h2>
        <div class="index-services--delimiter delimiter"><?= renderIcon('delimiter') ?></div>

        <div class="index-services--item js-wrap">
            <div class="index-services--item--title js-wrap-title"><?= Loc::getMessage('Restaurant') ?> <?= renderIcon('shevron') ?></div>
            <div class="index-services--item--content js-wrap-content">
                <div class="index-services--item--image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/service-restaurants.jpg" alt="<?= Loc::getMessage('Restaurant') ?>" class="img-fluid">
                </div>
                <div class="index-services--item--description">
                    Мы приглашаем Вас отдохнуть в роскошной обстановке ресторана Freesia. Разнообразные блюда европейской и средиземноморской кухни восхищают наших гостей идеальным сочетанием вкуса и подачи
                </div>
                <div class="index-services--item--link">
                    <a href="/restaurants/" class="btn btn-white"><?= Loc::getMessage('More detailed') ?></a>
                </div>
            </div>
        </div>

        <div class="index-services--item js-wrap">
            <div class="index-services--item--title js-wrap-title"><?= Loc::getMessage('Entertainments') ?> <?= renderIcon('shevron') ?></div>
            <div class="index-services--item--content js-wrap-content">
                <div class="index-services--item--image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/service-entertainments.jpg" alt="<?= Loc::getMessage('Entertainments') ?>" class="img-fluid">
                </div>
                <div class="index-services--item--description">
                    Мы приглашаем Вас отдохнуть в роскошной обстановке ресторана Freesia. Разнообразные блюда европейской и средиземноморской кухни восхищают наших гостей идеальным сочетанием вкуса и подачи
                </div>
                <div class="index-services--item--link">
                    <a href="/entertainment/" class="btn btn-white"><?= Loc::getMessage('More detailed') ?></a>
                </div>
            </div>
        </div>

        <div class="index-services--item js-wrap">
            <div class="index-services--item--title js-wrap-title"><?= Loc::getMessage('Events') ?> <?= renderIcon('shevron') ?></div>
            <div class="index-services--item--content js-wrap-content">
                <div class="index-services--item--image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/service-events.jpg" alt="<?= Loc::getMessage('Events') ?>" class="img-fluid">
                </div>
                <div class="index-services--item--description">
                    Мы приглашаем Вас отдохнуть в роскошной обстановке ресторана Freesia. Разнообразные блюда европейской и средиземноморской кухни восхищают наших гостей идеальным сочетанием вкуса и подачи
                </div>
                <div class="index-services--item--link">
                    <a href="/events/" class="btn btn-white"><?= Loc::getMessage('More detailed') ?></a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="index-content">
    <h1 class="index-title page-title text-center"><?= SITE_CONFIG['name_short'] ?></h1>
    <div class="index-image">
        <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
    </div>

    <!--об отеле-->
    <div class="index-about">
        <h2 class="index-about--title"><?= Loc::getMessage('Offers') ?></h2>
        <div class="delimiter"><?= renderIcon('delimiter') ?></div>
        <p>Гранд Отель "Валентина" является визитной карточкой города-курорта Анапа,<br> ежегодно подтверждая статус пятизвездочного отеля.</p>
    </div>

    <!--об отеле (дополнительно)-->
    <div class="index-about--add index-about--add--top">
        <h3>Здесь есть всё для комфортного отдыха и даже больше</h3>
        <div class="delimiter"><?= renderIcon('delimiter') ?></div>
        <p>Выгодное местоположение - мы находимся в самом центре города.</p>
        <p>Квалифицированный персонал - наша команда решит любые вопросы и задачи, чтобы Вы могли забыть о хлопотах и лишь наслаждаться отдыхом.</p>
    </div>

    <div class="index-about--add--wrapper">

        <div class="index-about--add--item">
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-1.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>
            <div class="index-about--add">
                <p><a href="/rooms/">Номерной фонд</a> с различными планировочными решениями обеспечивает комфортные условия для отдыха семьей, компанией или вдвоем.</p>
            </div>
        </div>

        <div class="index-about--add--item">
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-2.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>
            <div class="index-about--add">
                <p><a href="/restaurants/">Ресторан Freesia</a> удивит блюдами европейской кухни и поможет в организации кейтеринга. В стоимость проживания включен завтрак в ресторане по континентальному меню в низкий сезон, а в высокий сезон - шведский стол.</p>
            </div>
        </div>

        <div class="index-about--add--item">
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-3.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>
            <div class="index-about--add">
                <p><a href="/events/">Конференц-залы</a>, оборудованные под проведение мероприятий любой сложности в Анапе.</p>
            </div>
        </div>

        <div class="index-about--add--item">
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-4.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>
            <div class="index-about--add">
                <p>Оборудованный <a href="/entertainment/">пляж с развитой инфраструктурой</a>, открытым подогреваемым бассейном, фудкортом и рыбным рестораном 27 причал. На территорию пляжа в летний период вас доставят комфортабельные электрокары.</p>
            </div>
        </div>

    </div>

    <!--об отеле (резюме)-->
    <div class="index-about--resume">
        <div class="index-about--resume--wrapper">
            <div class="index-about--resume--wrap">
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <p>Всё это и ещё многое другое делает нас<br>одним из лучших отелей черноморского побережья</p>
            </div>
        </div>
    </div>

    <!--контакты-->
    <div class="index-contacts">
        <h2 class="index-contacts--title"><?= Loc::getMessage('Contacts') ?></h2>
        <div class="index-contacts--delimiter delimiter"><?= renderIcon('delimiter') ?></div>
        <div class="index-contacts--items">
            <?php if (!empty(SITE_CONFIG['phone'])): ?>
                <div class="index-contacts--phone">
                    <?= Core::parsePhone(SITE_CONFIG['phone'], 'link') ?>
                </div>
            <?php endif; ?>
            <?php /* if (!empty(SITE_CONFIG['email'])): ?>
                <div class="index-contacts--email">
                    <?= Core::renderEmail(SITE_CONFIG['email']) ?>
                </div>
            <?php endif; */ ?>
            <?php if (!empty(SITE_CONFIG['address'])): ?>
                <div class="index-contacts--address"><?= SITE_CONFIG['address'] ?></div>
            <?php endif; ?>
        </div>
        <div class="index-contacts--map">
            <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/map.php', array('points' => $points)) ?>
        </div>
    </div>

    <!--подписка-->
    <div class="index-subscribe">
        <div class="index-subscribe--wrapper">
            <?= view('forms.subscribe', [
                'APPLICATION' => $APPLICATION,
                'id' => 'index-subscribe'
            ], false) ?>
        </div>
    </div>

</div>
