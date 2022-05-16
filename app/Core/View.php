<?php

declare(strict_types=1);

namespace MVC\Core;

class View
{
    /**
     * Checks if a given file in the "views" folder exists and returns its content if found
     *
     * @param string $path
     * @return false|string
     */
    public static function render(string $path, array $params = []): string
    {
        if (file_exists(__DIR__ . "/../Views/$path.php")) {
            extract($params, EXTR_SKIP);
            ob_start();
            require __DIR__ . "/../Views/$path.php";
            return ob_get_clean();
        }

        return self::errorPage("error","View Not Found");
    }

    /**
     * Takes the path of a view from the app/Views folder that passes a given errorMessage into the parameters
     *
     * @param string $path
     * @param string|null $errorMessage
     * @return string
     */
    public static function errorPage(string $path, string $errorMessage = null): string
    {
        return self::render($path,[
            'errorMessage' => $errorMessage
        ]);
    }

}