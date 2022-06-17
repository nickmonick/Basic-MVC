<?php

declare(strict_types=1);

namespace MVC\Core;

abstract class BaseController
{
    /**
     * Automatically escapes data weather it is an array or a string
     *
     * @param string|array $value
     * @return string|array
     */
    protected function esc(string | array $value): string | array
    {
        if (is_array($value)) {
            return array_map(fn($value): string => htmlspecialchars($value), $value);
        }
        return htmlspecialchars($value);
    }

    /**
     * Function to output formatted var_dump data
     *
     * @param array|object $var
     * @return void
     */
    protected function dump(array | object | string $var): void
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    /**
     * Returns Json encoded data
     *
     * @param string|array|object|int|float $data
     * @return string
     */
    protected function json(string|array|object|int|float $data): string
    {
        header("Content-Type: application/json");
        return json_encode($data);
    }
}