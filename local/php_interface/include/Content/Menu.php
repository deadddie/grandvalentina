<?php


namespace LapkinLab\Content;

/**
 * Class Menu
 *
 * Использует массивы bitrix-меню.
 *
 * @package LapkinLab\Content
 */
class Menu
{
    protected const TOP_MENU = '.top.menu.php';

    /**
     * Вывод верхнего меню.
     *
     * @return false|string|null
     */
    public static function getTopMenu($submenu = true)
    {
        $menu = [];

        ob_start();
        include ROOT . DIRECTORY_SEPARATOR . self::TOP_MENU;
        ob_get_clean();
        $menu['menu'] = $aMenuLinks;

        if ($submenu) {
            $menu['rooms'] = Rooms::getMenu();
            $menu['restaurants'] = Restaurants::getMenu();
            $menu['events'] = Events::getMenu();
        }

        return view('common.top_menu', array('menu' => $menu), false);
    }


}
