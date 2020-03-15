<?php

use LapkinLab\Core;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Об отеле');
$APPLICATION->SetTitle('Об отеле');

?>
<div class="page-about">
    <div class="page-about--wrapper">

        <h1 class="page-title text-center">Grand Hotel Valentina</h1>

        <div class="page-about--image">
            <img src="images/about-1.jpg" alt="<?= SITE_CONFIG['name_short'] ?>">
        </div>

        <div class="page-about--text">
            <div class="page-about--text-wrapper">
                <div class="page-about--text--title">Об отеле</div>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <div class="page-about--text--content">Гранд Отель "Валентина" является визитной карточкой города-курорта Анапа, ежегодно подтверждая статус пятизвездочного отеля.</div>
            </div>
        </div>

        <div class="page-about--gallery">
            <div class="page-about--gallery--title">Галерея</div>
            <div class="delimiter"><?= renderIcon('delimiter') ?></div>
            <div class="about-detail--images">
                <ul>
                    <li><img src="images/about-gallery-01.jpg" alt="<?= SITE_CONFIG['name_short'] ?>"></li>
                </ul>
                <div class="about-detail--images--nav">
                    <?= view('common.slider_navigation', ['type' => 'about'], false) ?>
                </div>
            </div>
        </div>

        <div class="page-about--text">
            <div class="page-about--text-wrapper">
                <div class="page-about--text--title">Время – самый ценный ресурс</div>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <div class="page-about--text--content">Гранд отель «Валентина» вкладывает особый смысл в эти слова</div>
                <div class="page-about--text--summary">На протяжении уже более 10 лет, чтя наследие и традиции, мы дорожим тем временем, которое Вы проводите выбрав наш отель, и с особым трепетом заботимся о том, чтобы Вы провели его с максимальным комфортом и пользой для себя.</div>
            </div>
        </div>

        <div class="page-about--image">
            <img src="images/about-2.jpg" alt="<?= SITE_CONFIG['name_short'] ?>">
        </div>

        <div class="page-about--resume">
            <div class="page-about--resume-wrapper">
                <p>Сердце города</p>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <p>Центр бизнеса</p>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <p>Точка комфорта</p>
            </div>
        </div>

    </div>

</div>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
