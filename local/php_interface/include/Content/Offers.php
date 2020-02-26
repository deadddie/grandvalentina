<?php


namespace LapkinLab\Content;

/**
 * Class Offers
 *
 * @package LapkinLab\Content
 */
class Offers
{
    public const OFFERS_IBLOCK_ID = OFFERS_IBLOCK_ID;

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    use CommonTrait;

    /**
     * Вывод спецпредложения (по ID или по символьному коду).
     *
     * @param $id
     *
     * @return false|string|null
     */
    public static function getDetail($id)
    {
        global $DB;
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array();
            $arFilter = array(
                'IBLOCK_ID' => self::OFFERS_IBLOCK_ID,
                'ACTIVE' => 'Y',
                'DATE_ACTIVE_TO' => date($DB->DateFormatToPHP(\CLang::GetDateFormat('SHORT'))),
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
            $params['offer'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect)->GetNextElement();
        }
        return view('offers.detail', $params, false);
    }

    /**
     * Список спецпредложений.
     *
     * @param string $mode
     *
     * @return false|string|null
     */
    public static function getList(string $mode = 'list')
    {
        global $DB;
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
                'DATE_ACTIVE_TO' => 'desc',
            );
            $arFilter = array(
                'IBLOCK_ID' => self::OFFERS_IBLOCK_ID,
                'ACTIVE' => 'Y',
                '>DATE_ACTIVE_TO' => ConvertTimeStamp(time(),'FULL'),
            );
            $arGroupBy = false;
            $arNavStartParams = ($mode === 'block') ? ['nTopCount' => 3] : false;
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
            $params['offers'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
            $params['mode'] = $mode;
        }
        return view('offers.list', $params, false);
    }
}
