<?php
namespace Building\Controllers;

class Controller {
    /**
     * Render 1 view
     *
     * @param string $view   Tên file view (không có .php)
     * @param array  $data   Dữ liệu truyền sang view
     * @return string        HTML đã render
     */
    protected function render($view, $data = []) {
        extract($data); // biến $data['x'] => $x

        ob_start();
        $file = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<!-- View $view not found -->";
        }
        return ob_get_clean();
    }
}
