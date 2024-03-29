<?php

declare(strict_types=1);

namespace MVC\Core;

use Exception;
use PDO;

abstract class Model extends Database
{
    use Validation;
    /**
     * Gets all the columns in the given table name given from the model and adds properties that can be used from the models object
     */

    public function __construct(array $data = null)
    {
        $this->{"valid"} = null;
        parent::__construct();
        $tableName = $this->{"tableName"};
        $stmt = $this->db->query( "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tableName."'", PDO::FETCH_OBJ );
        $columns = $stmt->fetchAll();
        foreach ($columns as $column) {
            if ($column->TABLE_SCHEMA === $this->database) {
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
    private function loadData (array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key) && in_array($key,$this->{"allowedFields"})) {
                $this->{$key} = $value;
            }
        }
    }
}