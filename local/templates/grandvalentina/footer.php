<?php

use Bitrix\Main\Localization\Loc;
use LapkinLab\{Core, Content\Rooms};


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadLanguageFile(__FILE__);

?>
</main><!--/main-->

<!--footer-->
<footer id="footer" class="footer">

    <div class="container">
        <div class="row">
            <div class="footer--wrapper col-12">
                <div class="footer--logo">
                    <div class="logo-vertical">
                        <?= Core::renderIcon('logo') ?>
                        <span><?= SITE_CONFIG['name_short'] ?></span>
                    </div>
                </div>
                <div class="footer--rooms">
                    <div class="footer--rooms--title">Номера</div>
                    <div class="footer--rooms--items">
                        <?= Rooms::getList('list') ?>
                    </div>
                </div>
                <div class="footer--menu">
                    <div class="footer--menu--title">Меню</div>
                    <div class="footer--menu--items">
                        <?php $APPLICATION->IncludeComponent(
                            'bitrix:menu',
                            'top',
                            array(
                                'ALLOW_MULTI_SELECT' => 'N',
                                'CHILD_MENU_TYPE' => 'top',
                                'DELAY' => 'N',
                                'MAX_LEVEL' => 2,
                                'MENU_CACHE_GET_VARS' => array(''),
                                'MENU_CACHE_TIME' => 3600,
                                'MENU_CACHE_TYPE' => 'N',
                                'MENU_CACHE_USE_GROUPS' => 'Y',
                                'ROOT_MENU_TYPE' => 'top',
                                'USE_EXT' => 'N',
                            )
                        ); ?>
                    </div>
                </div>
                <div class="footer--contacts">
                    <div class="footer--contacts-wrapper">
                        <div class="footer--contacts-items">
                            <?php if (!empty(SITE_CONFIG['phone'])): ?>
                                <div class="footer--contacts-phone">
                                    <?= Core::parsePhone(SITE_CONFIG['phone'], 'link') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(SITE_CONFIG['email'])): ?>
                                <div class="footer--contacts-email">
                                    <?= Core::renderEmail(SITE_CONFIG['email']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty(SITE_CONFIG['address'])): ?>
                            <div class="footer--contacts-address"><?= SITE_CONFIG['address'] ?></div>
                        <?php endif; ?>
                        <div class="footer--socials">
                            <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/social_links.php', array('socials' => SITE_CONFIG['socials'], 'simple' => false)) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="footer--copyrights">
                    &copy; <?= Core::autoCopyright(SITE_CONFIG['since']) ?> Официальный
                    сайт <?= SITE_CONFIG['name_short'] ?>
                </div>
            </div>
        </div>
    </div>

</footer><!--/footer-->

<!--scroll to top-->
<div class="hidden-xs" id="scroll-to-top"><a href="#top" title="наверх" rel="nofollow">↑</a></div>

</div><!--/#top-->

<!--modals container-->
<div id="ajax-modals-container"></div>

<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/seo.php') ?>

</body>
</html>
