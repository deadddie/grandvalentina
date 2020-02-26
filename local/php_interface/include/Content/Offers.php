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
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array();
            $arFilter = array(
                'IBLOCK_ID' => self::OFFERS_IBLOCK_ID,
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
            $params['offer'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect)->GetNextElement();
        }
        return view('offers.detail', $params, false);
    }

    /**
     * Список спецпредложений.
     *
     * @param string $mode block|list|card|archive
     *
     * @return false|string|null
     */
    public static function getList(string $mode = 'list')
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
                'DATE_ACTIVE_TO' => 'desc',
            );
            $dateActiveWay = $mode !== 'archive' ? '>DATE_ACTIVE_TO' : '<DATE_ACTIVE_TO';
            $arFilter = array(
                'IBLOCK_ID' => self::OFFERS_IBLOCK_ID,
                'ACTIVE' => 'Y',
                $dateActiveWay => ConvertTimeStamp(time(),'FULL'),
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
            $params['offers'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
            $params['mode'] = $mode;
        }
        return view('offers.list', $params, false);
    }
}
