<?php


namespace LapkinLab\Content;


use LapkinLab\Core;

/**
 * Trait CommonTrait
 *
 * @package LapkinLab\Content
 */
trait CommonTrait
{
    /**
     * Вывод списка изображений.
     *
     * @param array $more_images
     * @param string $alt
     * @param string $class
     *
     * @return false|string|null
     */
    public static function getMoreImages($more_images, $alt = '', $class = '')
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
     * @param integer $id
     * @param string $alt
     * @param string $class
     *
     * @return false|string|null
     */
    public static function getImage($id, $alt = '', $class = '')
    {
        $image = \CFile::GetByID($id)->GetNext();
        $resized = Core::resizeImage($image, false, 720, 480);
        $resized['alt'] = $alt;
        $resized['class'] = $class;
        $params['image'] = $resized;
        return view('common.image', $params, false);
    }
}