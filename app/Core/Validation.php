<?php

declare(strict_types=1);

namespace MVC\Core;

trait Validation
{
    public function minLength(string $field, int $length, string $value): bool
    {
        $valid = strlen($value) > $length;
        if (!$valid) {
            $this->{"errors"}[$field] = str_replace("%", "$length",$this->{'errorMessages'}[$field]['minlength'] ?? "ERROR");
        }

        return $valid;
    }

    public function maxLength(string $field, int $length, string $value): bool
    {
        $valid = strlen($value) < $length;

        if (!$valid) {
            $this->{"errors"}[$field] = str_replace("%", "$length",$this->{'errorMessages'}[$field]['maxlength'] ?? "ERROR");
        }

        return $valid;
    }

    public function required(string $field, string $value): bool
    {
        $valid = !empty($value);

        if (!$valid) {
            $this->{"errors"}[$field] = $this->{"errorMessages"}[$field]['required'] ?? "ERROR";
        }

        return $valid;
    }

}