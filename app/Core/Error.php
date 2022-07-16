<?php

declare(strict_types=1);

namespace MVC\Core;

class Error
{
    public static function exceptionHandler(object $exception): void
    {
        $code = $exception->getCode();
        if ($code !== 404) {
            $code = 500;
        }

        http_response_code($code);
        if ($_ENV['config.SHOWERRORS'] === "true") {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        }


    }
}