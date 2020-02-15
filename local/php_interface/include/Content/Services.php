<?php


namespace LapkinLab\Content;

/**
 * Class Services
 *
 * @package LapkinLab\Content
 */
class Services
{
    public const SERVICES_IBLOCK_ID = SERVICES_IBLOCK_ID;

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    use CommonTrait;

    /**
     * Вывод услуги (по ID или по символьному коду).
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
                'IBLOCK_ID' => self::SERVICES_IBLOCK_ID,
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
            $params['service'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect)->GetNextElement();
        }
        return view('services.detail', $params, false);
    }

    /**
     * Список услуг.
     *
     * @param $mode
     *
     * @return false|string|null
     */
    public static function getList($mode = 'list')
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
            );
            $arFilter = array(
                'IBLOCK_ID' => self::SERVICES_IBLOCK_ID,
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
            $params['services'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
            $params['mode'] = $mode;
        }
        return view('services.list', $params, false);
    }
}
