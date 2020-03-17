<?php


namespace LapkinLab\Content;

/**
 * Class Rooms
 *
 * @package LapkinLab
 */
class Rooms
{
    public const ROOMS_IBLOCK_ID = ROOMS_IBLOCK_ID;
    public const ROOM_SERVICES_IBLOCK_ID = ROOM_SERVICES_IBLOCK_ID;

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    use CommonTrait;

    /**
     * Вывод номера (по ID или по символьному коду).
     *
     * @param $id
     *
     * @return false|string|null
     */
    public static function getDetail($id)
    {
        $params = [];
        $params['room'] = self::getById($id);
        return view('rooms.detail', $params, false);
    }

    /**
     * Выборка элемента инфоблока.
     *
     * @param $id
     *
     * @return \_CIBElement|array|bool
     */
    public static function getById($id)
    {
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array();
            $arFilter = array(
                'IBLOCK_ID' => self::ROOMS_IBLOCK_ID,
                'ACTIVE' => 'Y',
            );
            if ((int) $id === 0) {
                $arFilter['CODE'] = $id;
            } else {
                $arFilter['ID'] = $id;
            }
            $arGroupBy = false;
            $arNavStartParams = false;
            $arSelect = array(
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_ID',
                'DETAIL_PICTURE',
                'DETAIL_TEXT',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'ACTIVE',
                'SORT',
                'DETAIL_PAGE_URL',
                'PROPERTY_*',
            );
            return \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect)->GetNextElement();
        }
        return false;
    }

    /**
     * Список номеров.
     *
     * @param string $mode
     *
     * @return false|string|null
     */
    public static function getList(string $mode = 'list')
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
            );
            $arFilter = array(
                'IBLOCK_ID' => self::ROOMS_IBLOCK_ID,
                'ACTIVE' => 'Y',
                'PROPERTY_CHECKED_MENU' => 'Y',
            );
            $arGroupBy = false;
            $arNavStartParams = ($mode === 'block') ? ['nTopCount' => 5] : false;
            $arSelect = array(
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_ID',
                'DETAIL_PICTURE',
                'DETAIL_TEXT',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'ACTIVE',
                'SORT',
                'DETAIL_PAGE_URL',
                'PROPERTY_*',
                //'SHOW_COUNTER',
            );
            $params['rooms'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
            $params['mode'] = $mode;
        }
        return view('rooms.list', $params, false);
    }

    /**
     * Меню номеров.
     *
     * @return array
     */
    public static function getMenu()
    {
        $rooms = $menu = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
            );
            $arFilter = array(
                'IBLOCK_ID' => self::ROOMS_IBLOCK_ID,
                'ACTIVE' => 'Y',
                'PROPERTY_CHECKED_MENU' => 'Y',
            );
            $arGroupBy = false;
            $arNavStartParams = false;
            $arSelect = array(
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_ID',
                'DETAIL_PICTURE',
                'DETAIL_TEXT',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'ACTIVE',
                'SORT',
                'DETAIL_PAGE_URL',
                'PROPERTY_*',
                //'SHOW_COUNTER',
            );
            $rooms = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
        }
        while ($room = $rooms->GetNextelement()) {
            $arFields = $room->GetFields();
            $menu[] = array(
                $arFields['NAME'],
                $arFields['DETAIL_PAGE_URL'],
                array(),
                array(),
                ''
            );
        }
        return $menu;
    }

    /**
     * Вывод списка услуг в номере.
     *
     * @param $room_services
     *
     * @return false|string|null
     */
    public static function getRoomServices($room_services)
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array();
            $arFilter = array(
                'ID' => $room_services,
                'IBLOCK_ID' => self::ROOM_SERVICES_IBLOCK_ID,
                'ACTIVE' => 'Y',
            );
            $arGroupBy = false;
            $arNavStartParams = false;
            $arSelect = array(
                'ID',
                'NAME',
                'CODE',
                'ACTIVE',
                'SORT',
            );
            $params['services'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
        }
        return view('rooms.services_list', $params, false);
    }
}
