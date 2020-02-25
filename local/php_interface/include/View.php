<?php


namespace LapkinLab;

/**
 * Class View
 *
 * @package LapkinLab
 */
class View
{
    use ResponseTrait;

    protected const DIR = VIEWS_DIR;

    /**
     * Рендер представления (view).
     *
     * @param $name
     * @param array $params
     * @param bool $print
     *
     * @return false|string|null
     */
    public static function make($name, $params = array(), $print = true)
    {
        // Проброс экземпляра приложения во view
        $name = str_replace('.', DIRECTORY_SEPARATOR, $name);
        $filePath = ROOT . DIRECTORY_SEPARATOR . self::DIR . $name . '.php';
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
