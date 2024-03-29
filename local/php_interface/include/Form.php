<?php


namespace LapkinLab;

use Bitrix\Main\Application;
use Respect\Validation\Validator as v;
use LapkinLab\CyrillicUrlValidationRule as vCyrUrl;

/**
 * Class Form
 *
 * @package LapkinLab
 */
class Form
{
    use ResponseTrait;

    private const IBLOCK = ORDERS_IBLOCK_ID;

    protected $request;

    protected $form_id;
    protected $name;
    protected $surname;
    protected $phone;
    protected $email;
    protected $message;
    protected $privacy;

    protected $required; // данные о required полях

    protected $url;
    protected $ip;
    protected $datetime;

    protected const VALIDATE_ERRORS = array(
        'ok' => 'OK',
        'sessid' => 'Ошибка сессии. Попробуйте перезагрузить страницу',
        'form' => 'Ошибка формы',
        'required' => 'Обязательно для заполнения',
        'format' => array(
            'email' => 'Неверный формат почтового адреса',
            'phone' => 'Неверный формат номера телефона',
            'default' => 'Неверный формат данных',
        ),
    );

    /**
     * Form constructor.
     *
     * @throws \Bitrix\Main\SystemException
     */
    public function __construct() {
        $application = Application::getInstance();
        $context = $application->getContext();

        $this->request = $context->getRequest();

        $this->required = explode(',', base64_decode($this->request->get('required')));

        $this->form_id = $this->request->get('id');
        $this->name = $this->request->get('name');
        $this->surname = $this->request->get('surname');
        $this->phone = $this->request->get('phone');
        $this->email = $this->request->get('email');
        $this->message = $this->request->get('message');
        $this->privacy = $this->request->get('privacy');

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $this->ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $this->ip = $forward;
        } else {
            $this->ip = $remote;
        }
        $this->datetime = date('d.m.Y H:i:s');

        $this->validate();
    }

    /**
     * Запись в элемент инфоблока.
     */
    public function createIBlockElement()
    {
        $element = new \CIBlockElement;
        $elementName = "Заявка от {$this->datetime} ({$this->name})";
        $elementFields = array(
            'ACTIVE' => 'Y',
            'IBLOCK_SECTION_ID' => false,
            'IBLOCK_ID' => self::IBLOCK,
            'NAME' => $elementName,
            'PROPERTY_VALUES' => array(
                23 => $this->name,
                25 => $this->phone,
                26 => $this->email,
                27 => $this->message,
                28 => $this->ip,
                29 => $this->url,
                22 => $this->form_id,
            ),
        );
        return $element->Add($elementFields);
    }

    /**
     * Отправка почты.
     *
     * @param array $to
     *
     * @return bool|void
     */
    public function sendEmail($to = array(SITE_CONFIG['email']))
    {
        if (count($to) === 0) return;

        $to = implode(', ', $to);
        $subject = 'Заявка с сайта «Отель Гранд Валентина»';

        $headers = <<<HEADERS
MIME-Version: 1.0
Content-type: text/html; charset=utf-8
From: grandvalentina.ru <mail@grandvalentina.ru>
HEADERS;

        $message = <<<BODY
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Заявка с сайта «Отель Гранд Валентина»</title>
    </head>
    <body>
        <p>Заявка с сайта «Отель Гранд Валентина»</p>
        <p>Форма: {$this->form_id}</p>
        <p>Имя: {$this->name}<br>
            Почта: {$this->email}<br>
            Телефон: {$this->phone}<br>
            Сайт: {$this->site}<br>
            Сообщение: {$this->message}<br>
        </p>
        <p>Тариф: {$this->tarif}<br>
            Тип сайта: {$this->site_type}
        </p>
        <p>Страница отправки: {$this->url}<br>
            IP отправки: {$this->ip}<br>
            Заявка от {$this->datetime} ({$this->name})
        </p>
        <p>---<br>Это автоматическое сообщение.</p>
    </body>
</html>
BODY;
        return bxmail($to, $subject, $message, $headers);
    }

    /**
     * Валидация полей.
     *
     * @return array
     */
    public function validate()
    {
        $errors = array();

        // Проверка сессии
        if (check_bitrix_sessid()) {

            // Проверка required-полей
            $this->checkRequired($errors);

            // Валидация полей
            if (!empty($this->name) && !v::length(1, 60)->validate($this->name)) {
                $errors['name'][] = self::VALIDATE_ERRORS['format']['default'];
            }
            if (!empty($this->email) && !v::noWhitespace()->email()->validate($this->email)) {
                $errors['email'][] = self::VALIDATE_ERRORS['format']['email'];
            }
            if (!empty($this->phone) && !v::noWhitespace()->phone()->validate($this->phone)) {
                $errors['phone'][] = self::VALIDATE_ERRORS['format']['phone'];
            }
            if (!empty($this->message) && !v::length(1, 1000)->validate($this->message)) {
                $errors['message'][] = self::VALIDATE_ERRORS['format']['default'];
            }

        } else {
            $errors['sessid'] = self::VALIDATE_ERRORS['sessid'];
        }
        return $errors;
    }

    /**
     * Обязательное поле?
     *
     * @param $field
     *
     * @return bool
     */
    protected function isRequired($field)
    {
        return in_array($field, $this->required, true);
    }

    /**
     * Проверка required полей.
     *
     * @param $errors
     *
     * @return void
     */
    protected function checkRequired(&$errors): void
    {
        foreach ($this->required as $require) {
            if (empty($this->$require)) {
                $errors[$require][] = self::VALIDATE_ERRORS['required'];
            }
        }
    }

}
