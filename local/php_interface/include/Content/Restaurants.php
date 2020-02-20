<?php


namespace LapkinLab\Content;

/**
 * Class Restaurants
 *
 * @package LapkinLab\Content
 */
class Restaurants
{
    public const RESTAURANTS_IBLOCK_ID = RESTAURANTS_IBLOCK_ID;

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    use CommonTrait;

    /**
     * Вывод мероприятия (по ID или по символьному коду).
     *
     * @param $id
     *
     * @return false|string|null
     */
    public static function getDetail($id)
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array();
            $arFilter = array(
                'IBLOCK_ID' => self::RESTAURANTS_IBLOCK_ID,
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
            $params['restaurant'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect)->GetNextElement();
        }
        return view('restaurants.detail', $params, false);
    }

    /**
     * Список мероприятий.
     *
     * @param $mode
     *
     * @return mixed
     */
    public static function getList($mode = 'list')
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
            );
            $arFilter = array(
                'IBLOCK_ID' => self::RESTAURANTS_IBLOCK_ID,
                'ACTIVE' => 'Y',
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
            $params['restaurants'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
            $params['mode'] = $mode;
        }
        if ($mode === 'menu') {
            return self::getMenu($params['restaurants']);
        }
        return view('restaurants.list', $params, false);
    }

    /**
     * @param $items
     *
     * @return array
     */
    protected static function getMenu($items)
    {
        $menu = [];
        foreach ($items as $item) {
            $menu[] = [
                $item['NAME'],
                $item['DETAIL_PAGE_URL'],
                [],
                [],
                ''
            ];
        }
        return $menu;
    }

    /**
     * Ссылка на скачивание меню.
     *
     * @param $id
     * @param string $name
     *
     * @return false|string|null
     */
    public static function getMenuLink($id, $name = '')
    {
        $file = \CFile::GetByID($id)->Fetch();
        return view('common.download_file', [
            'file' => $file,
            'download' => $name . '.' . str_replace('application/', '', str_replace(' ', '_', $file['CONTENT_TYPE'])),
            'button_name' => 'меню',
        ], false);
    }
}
