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
    public function view(string $path): string
    {
        if (file_exists(__DIR__."/../views/$path.php")) {
            ob_start();
            require __DIR__."/../views/$path.php";
            return ob_get_clean();
        }
        else
            return "File Not Found";

    }
}