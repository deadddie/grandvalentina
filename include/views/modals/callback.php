<?php

/**
 * @var $id
 */

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$params = array(
    'id' => $id . '-modal',
    'title' => 'Оставьте заявку',
    'description' => 'Наш менеджер свяжется с вами в ближайшее время и ответит на все интересующие вас вопросы',
    'fields' => array(
        'name',
        'surname',
        'phone',
        'email',
        'privacy',
    ),
    'required' => array(
        'name',
        'surname',
        'phone',
        'privacy',
    ),
    'hidden' => array(),
    'submit_button' => 'Отправить заявку',
    'wrapper' => true,
); ?>
<div class="modal modal-<?= $id ?>" tabindex="-1" role="dialog" id="<?= $id ?>-modal">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><?= renderIcon('close') ?></button>
        <div class="modal-content">
            <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/form.php', $params) ?>
        </div>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
