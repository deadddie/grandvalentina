<?php

/**
 * @var $id
 */

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$params = array(
    'id' => $id . '-modal',
    'title' => 'Спасибо за ваше обращение!',
    'description' => 'Мы свяжемся с вами в ближайшее время по оставленным контактным данным.'
); ?>
    <div class="modal modal-<?= $id ?>" tabindex="-1" role="dialog" id="<?= $id ?>-modal">
        <div class="modal-dialog" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><?= renderIcon('close') ?></button>
            <div class="modal-content">
                <h2 class="lapkin-form--title text-center"><?= $params['title'] ?></h2>
                <p class="text-center"><?= $params['description'] ?></p>
            </div>
        </div>
    </div>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
