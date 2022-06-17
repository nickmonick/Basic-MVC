<?php

declare(strict_types=1);

namespace MVC\Core;

abstract class Model
{
    /**
     * Gets all the columns in the given table name given from the model and adds properties that can be used from the models object
     */
    public Database $db;
    private bool $canAdd = true;

    public function __construct(array $data = null)
    {
        $tableName = $this->{"tableName"};
        $this->db = new Database;
        $this->db->query( "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tableName."'");
        $columns = $this->db->resultSet();

        foreach ($columns as $column) {
            if ($column->TABLE_SCHEMA === $this->db->database) {
                $this->{$column->COLUMN_NAME} = null;
            }
        }

        if (!empty($data)) {
            $this->loadData($data);
        }
    }

    /**
     * This function filters through the given data (usually the _POST or _GET array) and filters through the models allowed fields to fill the objects' properties
     *
     * @param array $data
     * @return void
     */
    public function loadData (array $data): void
    {
        foreach ($data as $key => $value) {
            $this->canAdd = true;
            $currentRules = explode("|",$this->{"validation"}[$key]);

            foreach ($currentRules as $rule) {
                preg_match_all('!\d+!', $rule,$regexResult);
                $ruleValue = $regexResult[0][0];
                $rule = str_replace("_", "", $rule);
                $rule = preg_replace('/[0-9]+/', '', $rule);
                $rule = preg_replace('/[[]]/', '', $rule);
                preg_match_all("/^[a-zA-Z0-9]+$/",$rule, $ruleName);
                $finalRule = $ruleName[0][0];
                if ($finalRule === "minlength" && strlen($value) < $ruleValue) {
                    $this->canAdd = false;
                    break;
                }
                if ($finalRule === "maxlength" && strlen($value) > $ruleValue) {
                    $this->canAdd = false;
                    break;
                }
            }

            if (property_exists($this, $key) && in_array($key,$this->{"allowedFields"}) && $this->canAdd) {
                $this->{$key} = $value;
            }
        }
    }
}