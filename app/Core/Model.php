<?php

declare(strict_types=1);

namespace MVC\Core;

abstract class Model
{
    /**
     * Gets all the columns in the given table name given from the model and adds properties that can be used from the models object
     */
    public function __construct()
    {
        $tableName = $this->{"tableName"};
        $db = new Database;
        $db->query( "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tableName."'");
        $columns = $db->resultSet();

        foreach ($columns as $column) {
            if ($column->TABLE_SCHEMA === "$db->database") {
                $this->{$column->COLUMN_NAME} = null;
            }
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
            if (property_exists($this, $key) && in_array($key,$this->{"allowedFields"})) {
                $this->{$key} = $value;
            }
        }

    }
}