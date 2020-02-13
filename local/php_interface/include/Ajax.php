<?php


namespace LapkinLab;

use Bitrix\Main\Application;

/**
 * Class Ajax
 *
 * @package LapkinLab
 */
class Ajax
{
    use ResponseTrait;

    protected $request;

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    ### МОДАЛЬНЫЕ ОКНА

    /**
     * Открытие модального окна.
     *
     * @param $params
     *
     * @return false|string|null
     * @throws \Bitrix\Main\SystemException
     */
    public static function openModal($params)
    {
        //$result = self::initialize(__FUNCTION__);
        return view('modals.' . $params['modalId'], array('id' => $params['modalId']));
    }

    ### ФОРМЫ

    /**
     * Отправка формы.
     *
     * @param $params
     *
     * @return mixed
     * @throws \Bitrix\Main\SystemException
     */
    public static function sendForm($params)
    {
        $response = self::initialize(__FUNCTION__);

        $form = new Form();
        $errors = $form->validate();
        if (!empty($errors)) {
            $response['errors'] = $errors;
            return self::setCode($response, 200);
        }

        $to = array_merge(array(SITE_CONFIG['email']), SITE_CONFIG['send_to']);

        $form->createIBlockElement();
        $mail = $form->sendEmail($to);
        return self::setCode($response, $mail ? 200 : 500);
    }

}
