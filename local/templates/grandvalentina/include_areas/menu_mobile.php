<?php

use LapkinLab\Core;
use LapkinLab\Content\Menu;

?>
<!--mobile menu-->
<div class="mobile-menu">

    <!--mobile menu header-->
    <div class="mobile-menu--header">
        <div class="mobile-menu--header--wrapper col-12">

            <div class="mobile-menu--header--lang">
                <div class="mobile-menu--header--lang-current js-languages-switch">
                    <?= LANGUAGE_ID ?> <?= renderIcon('romb') ?>
                </div>
                <div class="languages-switcher" id="languages-switcher">
                    <?= view('common.languages', [], false) ?>
                </div>
            </div>

            <div class="mobile-menu--header--logo">
                <a href="/">
                    <div class="logo-vertical">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-colorful.svg" alt="<?= SITE_CONFIG['name_short'] ?>">
                        <span class="header--logo-text"><?= SITE_CONFIG['name_short'] ?></span>
                    </div>
                </a>
            </div>

            <div class="mobile-menu--header--close js-mobile-menu--close">
                <?= renderIcon('cross') ?>
            </div>

        </div>
    </div>

    <div class="mobile-menu-wrapper">

        <!--mobile menu callback-->
        <div class="mobile-menu--callback">
            <div class="mobile-menu--callback--wrapper col-12">
                <button type="button" class="btn btn-white js-open-modal" data-action="openModal" data-modal="callback">Обратный звонок</button>
            </div>
        </div>

        <!--mobile menu menu-->
        <div class="mobile-menu--menu">
            <div class="mobile-menu--menu--wrapper col-12">
                <?= Menu::getTopMenu() ?>
            </div>
        </div>

        <div class="mobile-menu--phone">
            <div class="mobile-menu--phone--wrapper col-12">
                <div class="mobile-menu--phone--button"><?= renderIcon('phone') ?></div>
            </div>
        </div>

        <!--mobile menu footer-->
        <div class="mobile-menu--footer">
            <div class="mobile-menu--footer--wrapper col-12">
                <div class="mobile-menu--footer--contacts">
                    <?php /* if (!empty(SITE_CONFIG['email'])): ?>
                        <div class="mobile-menu--footer--contacts-email">
                            <?= Core::renderEmail(SITE_CONFIG['email']) ?>
                        </div>
                    <?php endif; */ ?>
                    <?php if (!empty(SITE_CONFIG['phone'])): ?>
                        <div class="mobile-menu--footer--contacts-phone">
                            <?= Core::parsePhone(SITE_CONFIG['phone'], 'link') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty(SITE_CONFIG['address'])): ?>
                        <div class="mobile-menu--footer--contacts-address"><?= SITE_CONFIG['address'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mobile-menu--footer--socials">
                    <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/social_links.php', array('socials' => SITE_CONFIG['socials'], 'simple' => true)) ?>
                </div>
            </div>
        </div>

        <!--mobile menu footer-->
        <div class="mobile-menu--choose-room">
            <a href="/booking/" class="btn btn-wide">Подобрать номер</a>
            <button type="button" class="btn btn-wide btn-white js-open-modal" data-action="openModal" data-modal="callback">Обратный звонок</button>
        </div>

    </div>

</div>
