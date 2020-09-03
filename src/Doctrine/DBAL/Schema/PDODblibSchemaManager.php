<?php

namespace LapayGroup\DoctrinePdoDblib\Doctrine\DBAL\Schema;

class PDODblibSchemaManager extends \Doctrine\DBAL\Schema\MsSqlSchemaManager
{
    protected function _getPortableTableColumnDefinition($tableColumn) {
        // ensure upper case keys are there too...
        foreach ($tableColumn as $key => $value) {
            $tableColumn[strtoupper($key)] = $value;
        }
        return parent::_getPortableTableColumnDefinition($tableColumn);
    }

}
