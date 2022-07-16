<?php

declare(strict_types=1);

namespace MVC\Core;

trait Validation
{
    public function minLength(array $fields, array $lengths, array $values): object
    {
        for ($i = 0;$i < sizeof($fields); $i++) {

            $valid = strlen($values[$i]) > $lengths[$i];
            if (!$valid) {
                $this->{"valid"} = false;
                $this->{"errors"}[$fields[$i]] = str_replace("%", "$lengths[$i]",$this->{'errorMessages'}[$fields[$i]]['minlength'] ?? "ERROR");
            }
        }

        return $this;
    }

    public function maxLength(array $fields, array $lengths, array $values): object
    {
        for ($i = 0; $i < sizeof($fields); $i++) {
            $valid = strlen($values[$i]) < $lengths[$i];
            if (!$valid) {
                $this->{"valid"} = false;
                $this->{"errors"}[$fields[$i]] = str_replace("%", "$lengths[$i]",$this->{'errorMessages'}[$fields[$i]]['maxlength'] ?? "ERROR");
            }
        }

        return $this;
    }

    public function required(array $fields, array $values): object
    {
        for ($i = 0; $i < sizeof($fields); $i++) {
            $valid = !empty($values[$i]);

            if (!$valid) {
                $this->{"valid"} = false;
                $this->{"errors"}[$fields[$i]] = $this->{"errorMessages"}[$fields[$i]]['required'] ?? "ERROR";
            }
        }

        return $this;
    }

}