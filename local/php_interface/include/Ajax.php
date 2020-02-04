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
    protected $views_dir;

    /**
     * Ajax constructor.
     *
     * @throws \Bitrix\Main\SystemException
     */
    public function __construct() {
        $application = Application::getInstance();
        $context = $application->getContext();
        $this->request = $context->getRequest();

        $this->views_dir = VIEWS_DIR;
    }

    /**
     * Простая реализация шаблонов вывода (view).
     *
     * @param $name
     * @param array $params
     * @param bool $print
     *
     * @return false|string|null
     */
    protected function view($name, $params = array(), $print = true)
    {
        // Проброс экземпляра приложения во view
        $filePath = ROOT . $this->views_dir . $name . '.php';
        $output = null;
        if (file_exists($filePath)) {
            extract($params, EXTR_OVERWRITE); // Извлекаем переменные в локальный неймспейс
            ob_start();                                  // Начало буферизации вывода
            include $filePath;                           // Включение файла шаблона
            $output = ob_get_clean();                    // Конец буферизации и возврат контента
        } else {
            $result = [];
            $result['views'] = $name;
            return self::setCode($result, 404);
        }
        if ($print) {
            print $output;
            die();
        }
        return $output;
    }

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
        $ajax = new self();
        return $ajax->view('modals/' . $params['modalId'], array('id' => $params['modalId']));
    }

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
