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
     * Вывод превью изображения.
     *
     * @param integer $id
     * @param string $alt
     * @param string $class
     *
     * @return false|string|null
     */
    public static function getPreviewImage($id, $alt = '', $class = '')
    {
        $image = \CFile::GetByID($id)->GetNext();
        $resized = Core::resizeImage($image, false, 720, 480);
        $resized['alt'] = $alt;
        $resized['class'] = $class;
        $params['image'] = $resized;
        return view('common.image', $params, false);
    }

    /**
     * Вывод детального изображения.
     *
     * @param integer $id
     * @param string $alt
     * @param string $class
     *
     * @return false|string|null
     */
    public static function getDetailImage($id, $alt = '', $class = '')
    {
        $image = \CFile::GetByID($id)->GetNext();
        $resized = Core::resizeImage($image, false, 1600, 400);
        $resized['alt'] = $alt;
        $resized['class'] = $class;
        $params['image'] = $resized;
        return view('common.image', $params, false);
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
        $ext = pathinfo($file['FILE_NAME'], PATHINFO_EXTENSION);
        return view('common.download_file', [
            'file' => $file,
            'download' => htmlspecialcharsEx(str_replace([' ', '"'], '_',(!empty($name)) ? $name . '.' . $ext : $file['ORIGINAL_NAME'])),
            'button_name' => 'меню',
        ], false);
    }
}
