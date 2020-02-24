<?php

/**
 * @var $id
 */

$params = array(
    'id' => $id,
    'title' => 'Подпишитесь на спецпредложения',
    'title_delimiter' => true,
    'description' => 'Узнайте первыми о выгодных предложениях',
    'fields' => array(
        'email',
        'privacy',
    ),
    'required' => array(
        'email',
        'privacy',
    ),
    'hidden' => array(),
    'submit_button' => 'Подписаться',
    'wrapper' => false,
); ?>

<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/form.php', $params); ?>
