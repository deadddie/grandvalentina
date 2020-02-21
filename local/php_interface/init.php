<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Config\Configuration;
use LapkinLab\{Core, View};


define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ERROR_500', '500 Internal Server Error');
define('INCLUDE_DIR', SITE_TEMPLATE_PATH . '/include_areas/');
define('VIEWS_DIR', '/local/php_interface/views/');

define('SITE_CONFIG', Configuration::getInstance()->get('site'));

define('ROOMS_IBLOCK_ID', 1);
define('SERVICES_IBLOCK_ID', 2);
define('ROOM_SERVICES_IBLOCK_ID', 3);
define('EVENTS_IBLOCK_ID', 4);
define('BLOG_IBLOCK_ID', 5);
define('RESTAURANTS_IBLOCK_ID', 6);
define('ENTERTAINMENT_IBLOCK_ID', 7);
define('OFFERS_IBLOCK_ID', 8);

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';

### FUNCTION WRAPPERS ###

// Глобальные обертки для необходимых функций

function dump($value, $public = false) {
    Core::dump($value, $public);
}

function dd($value, $public = false) {
    Core::dd($value, $public);
}

function renderIcon(string $name, string $class = '') {
    return Core::renderIcon($name, $class);
}

function renderSprite(string $name, string $class = '') {
    return Core::renderSprite($name, $class);
}

function view($name, $params = array(), $print = true) {
    return (new View(VIEWS_DIR))->render($name, $params, $print);
}

### EVENT HANDLERS ###

EventManager::getInstance()->addEventHandlerCompatible('main', 'OnEpilog', array(Core::class, 'breadcrumbSetTitle'));
EventManager::getInstance()->addEventHandlerCompatible('main', 'OnEpilog', array(Core::class, 'сheck404Error'), 1);

EventManager::getInstance()->addEventHandlerCompatible('main', 'OnEndBufferContent', array(Core::class, 'deleteKernelCss')); // Убрать css
EventManager::getInstance()->addEventHandlerCompatible('main', 'OnEndBufferContent', array(Core::class, 'minifyHtml')); // Сжать html
//EventManager::getInstance()->addEventHandlerCompatible('main', 'onEndBufferContent', array(Core::class, 'deleteKernelJs')); // Убрать js
