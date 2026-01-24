<?php

namespace Core;

abstract class Controller {
    protected function render($view, $data = []) {
        extract($data);

        $viewPath = __DIR__ . "/../src/Views/layout/" . $view . ".php";

        if (file_exists($viewPath)) {
            include __DIR__ . "/../src/Views/layout/header.php";
            include $viewPath;
            include __DIR__ . "/../src/Views/layout/footer.php";

            } else {
            die("Error: La vista '{$view}' no se encuentra en {$viewPath}");
        }
    }
}