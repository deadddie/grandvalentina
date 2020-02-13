<?php


namespace LapkinLab;

/**
 * Class Content
 *
 * @package LapkinLab
 */
class Content
{
    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    ### НОМЕРА

    /**
     * @param $id
     *
     * @return false|string|null
     */
    public static function getRoom($id)
    {
        $params = [
            'id' => $id,
        ];
        return view('rooms.room', $params, false);
    }

    /**
     * Список номеров.
     *
     * @param $mode
     *
     * @return false|string|null
     */
    public static function getRoomList($mode = 'list')
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array(
                'SORT' => 'asc',
            );
            $arFilter = array(
                'IBLOCK_ID' => ROOMS_IBLOCK_ID,
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
            $params['rooms'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
            $params['mode'] = $mode;
        }
        return view('rooms.room_list', $params, false);
    }

    /**
     * Вывод номера.
     *
     * @param $code
     *
     * @return false|string|null
     */
    public static function getRoomDetail($code)
    {
        $params = [];
        if (\CModule::IncludeModule('iblock')) {
            $arOrder = array();
            $arFilter = array(
                'IBLOCK_ID' => ROOMS_IBLOCK_ID,
                'CODE' => $code,
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
            );
            $params['room'] = \CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect)->GetNextElement();
        }
        return view('rooms.room_detail', $params, false);
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
                'IBLOCK_ID' => ROOM_SERVICES_IBLOCK_ID,
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
        return view('common.services_list', $params, false);
    }

    /**
     * Вывод списка изображений.
     *
     * @param $more_images
     * @param string $alt
     * @param string $class
     *
     * @return false|string|null
     */
    public static function getRoomMoreImages($more_images, $alt = '', $class = '')
    {
        $params = [];
        $params['class'] = $class;
        if (!empty($more_images)) {
            foreach ($more_images as $image_id) {
                $image = \CFile::GetByID($image_id)->GetNext();
                $resized = Core::resizeImage($image, false, 720, 480);
                $resized['alt'] = $alt;
                $params['images'][] = $resized;
            }
        }
        return view('common.images_list', $params, false);
    }

    /**
     * Вывод изображения.
     *
     * @param $image_id
     * @param string $alt
     * @param string $class
     *
     * @return false|string|null
     */
    public static function getRoomImage($image_id, $alt = '', $class = '')
    {
        $params = [];
        $image = \CFile::GetByID($image_id)->GetNext();
        $resized = Core::resizeImage($image, false, 720, 480);
        $resized['alt'] = $alt;
        $resized['class'] = $class;
        $params = $resized;
        return view('common.image', $params, false);
    }

}
