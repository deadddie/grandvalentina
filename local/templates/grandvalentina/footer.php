<?php

use Bitrix\Main\Localization\Loc;
use LapkinLab\{Core, Content\Rooms, Content\Menu};


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
                        <?= renderIcon('logo') ?>
                        <span><?= SITE_CONFIG['name_short'] ?></span>
                    </div>
                </div>
                <div class="footer--rooms">
                    <div class="footer--rooms--title"><?= Loc::getMessage('Rooms') ?></div>
                    <div class="footer--rooms--items">
                        <?= Rooms::getList('list') ?>
                    </div>
                </div>
                <div class="footer--menu">
                    <div class="footer--menu--title"><?= Loc::getMessage('Menu') ?></div>
                    <div class="footer--menu--items">
                        <?= Menu::getTopMenu(false) ?>
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
                            <?php /* if (!empty(SITE_CONFIG['email'])): ?>
                                <div class="footer--contacts-email">
                                    <?= Core::renderEmail(SITE_CONFIG['email']) ?>
                                </div>
                            <?php endif; */ ?>
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
                    &copy; <?= Core::autoCopyright(SITE_CONFIG['since']) ?> <?= Loc::getMessage('Official website') ?> <?= SITE_CONFIG['name_short'] ?>
                </div>
            </div>
        </div>
    </div>

</footer><!--/footer-->

<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/cookie.php') ?>
<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/scrolltotop.php') ?>

</div><!--/#top-->

<!--modals container-->
<div id="ajax-modals-container"></div>

<?php if (SITE_CONFIG['env'] === 'production'): ?>
    <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/seo.php') ?>
<?php endif; ?>

</body>
</html>
