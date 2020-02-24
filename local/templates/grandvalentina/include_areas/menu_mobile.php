<?php

use LapkinLab\Core;

?>
<!--mobile menu-->
<div class="mobile-menu">

    <!--mobile menu header-->
    <div class="mobile-menu--header">
        <div class="mobile-menu--header--wrapper col-12">

            <div class="mobile-menu--header--lang">
                <div class="mobile-menu--header--lang-current js-languages-switch">RU <?= renderIcon('romb') ?></div>
                <?= view('common.languages', [], false) ?>
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
                <?php $APPLICATION->IncludeComponent(
                    'bitrix:menu',
                    'top',
                    array(
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'CHILD_MENU_TYPE'       => 'top',
                        'DELAY'                 => 'N',
                        'MAX_LEVEL'             => 2,
                        'MENU_CACHE_GET_VARS'   => array(''),
                        'MENU_CACHE_TIME'       => 3600,
                        'MENU_CACHE_TYPE'       => 'N',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'ROOT_MENU_TYPE'        => 'top',
                        'USE_EXT'               => 'N',
                    )
                ); ?>
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
                    <?php if (!empty(SITE_CONFIG['email'])): ?>
                        <div class="mobile-menu--footer--contacts-email">
                            <?= Core::renderEmail(SITE_CONFIG['email']) ?>
                        </div>
                    <?php endif; ?>
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
            <button type="button" class="btn btn-wide">Подобрать номер</button>
        </div>

    </div>

</div>
