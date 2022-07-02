<?php

declare(strict_types=1);

namespace MVC\Core;

class Validation
{
    public function minLength(int $length, string $field): bool
    {
        return strlen($field) < $length;
    }

    public function maxLength(int $length, string $field): bool
    {
        return strlen($field) > $length;
    }

    public function required(string $field): bool
    {
        return !empty($field);
    }

}