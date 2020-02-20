<?php

/**
 * @var $id
 */

$params = array(
    'id' => $id,
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
    'wrapper' => false,
); ?>

<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/form.php', $params); ?>
