<?php

use LapkinLab\Core;
use LapkinLab\Content\{Offers, Rooms};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Grand Hotel Valentina");

?>
<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/front_screen.php') ?>

<?= Offers::getList('block') ?>
<?= Rooms::getList('block') ?>

<div class="index-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="index-title page-title text-center"><?= SITE_CONFIG['name_short'] ?></h1>
            </div>
            <div class="index-image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>

            <!--об отеле-->
            <div class="index-about col-12">
                <h2 class="index-about--title">Об отеле</h2>
                <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                <p>Гранд Отель "Валентина" является визитной карточкой города-курорта Анапа, ежегодно подтверждая статус пятизвездочного отеля.</p>
            </div>

            <!--об отеле (дополнительно)-->
            <div class="index-about--add col-12">
                <h3>Здесь есть всё для комфортного отдыха и даже больше:</h3>
                <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                <p>Выгодное местоположение - мы находимся в самом центре города;<br>Высоко квалифицированный персонал - наша команда решит любые вопросы и задачи для того, чтобы Вы могли забыть о хлопотах и лишь наслаждаться отдыхом;</p>
            </div>
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-1.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>

            <div class="index-about--add col-12">
                <p>Номерной фонд с различными планировочными решениями обеспечит комфортное пребывание на протяжении всего отдыха;</p>
            </div>
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-2.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>

            <div class="index-about--add col-12">
                <p>Ресторан «Freesia» представляющий Вашему вниманию блюда европейской кухни, так же с легкостью поможет Вам в организации кейтеринга;<br>В проживание включен завтрак в европейском ресторане «Freesia» по континентальному меню;</p>
            </div>
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-3.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>

            <div class="index-about--add col-12">
                <p>Если же отдых очень тесно переплетен с работой, то к Вашим услугам конференц-залы, оборудованные под проведение мероприятий любой сложности;</p>
            </div>
            <div class="index-about--image">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/index/index-add-4.jpg" alt="<?= SITE_CONFIG['name_short'] ?>" class="img-fluid">
            </div>

            <div class="index-about--add col-12">
                <p>Собственный пляж с развитой инфраструктурой, открытым бассейном, фудкортом и рыбным рестораном «27 причал». На территорию пляжа в летний период вас доставят комфортабельные электрокары;</p>
            </div>

            <div class="index-about--resume col-12">
                <div class="index-about--resume--wrapper">
                    <div class="index-about--resume--wrap">
                        <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
                        <p>Всё это, и ещё многое другое делает нас одним из лучших отелей Черноморского побережья.</p>
                    </div>
                </div>
            </div>

            <!--контакты-->

        </div>
    </div>
</div>



<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
