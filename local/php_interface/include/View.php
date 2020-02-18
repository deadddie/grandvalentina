<?php


namespace LapkinLab;


use Bitrix\Main\Application;

/**
 * Class View
 *
 * @package LapkinLab
 */
class View
{
    use ResponseTrait;

    protected $request;
    protected $dir;

    /**
     * View constructor.
     *
     * @param $dir
     *
     * @throws \Bitrix\Main\SystemException
     */
    public function __construct($dir) {
        $application = Application::getInstance();
        $context = $application->getContext();
        $this->request = $context->getRequest();
        $this->dir = $dir;
    }

    /**
     * Рендер представления (view).
     *
     * @param $name
     * @param array $params
     * @param bool $print
     *
     * @return false|string|null
     */
    public function render($name, $params = array(), $print = true)
    {
        // Проброс экземпляра приложения во view
        $name = str_replace('.', '/', $name);
        $filePath = ROOT . $this->dir . $name . '.php';
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
}
