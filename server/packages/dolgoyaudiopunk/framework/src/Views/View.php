<?php
namespace DolgoyAudiopunk\Framework\Views;

class View
{
    /**
     * @var array<string>
     */
    public array $route = [];
    /**
     * @var string
     */
    public string $view;

    /**
     * @param array<string> $route
     * @param string        $view
     */
    public function __construct(array $route, string $view = '')
    {
        $this->route = $route;
        $this->view = $view;
    }

    /**
     * @param array<string>|string $data
     * @return void
     */
    public function render(array | string $data):void
    {
        if (is_array($data)) {
            extract($data);
        }

        $fileView = ROOT . '/App/Views/' . $this->view . '.php';

        ob_start();
        if (is_file($fileView)) {
            require $fileView;
        } else {
            echo '<h1>Файл не найден!' .  $fileView . '</h1>';
        }
        $content = ob_get_clean();

        $fileLayout = ROOT . '/App/Views/layouts/' . 'default' . '.php';

        if (is_file($fileLayout)) {
            require $fileLayout;
        } else {
            echo '<h1>Файл ШАБЛОНА не найден!</h1>';
        }
        echo $content;
    }
}
