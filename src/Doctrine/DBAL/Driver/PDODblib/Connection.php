<?php

namespace LapayGroup\DoctrinePdoDblib\Doctrine\DBAL\Driver\PDODblib;

class Connection extends \Doctrine\DBAL\Driver\PDOConnection implements \Doctrine\DBAL\Driver\Connection
{
    public function __construct($dsn, $user = null, $password = null, $options = null)
    {
        parent::__construct($dsn, $user, $password, $options);
        $this->setAttribute(\PDO::ATTR_STATEMENT_CLASS, array(PDOStatement::class, array()));
    }

    public function quote($value, $type = \PDO::PARAM_STR) {
        $val = parent::quote($value, $type);

        // Fix for a driver version terminating all values with null byte
        $val = rtrim($val, "\0");

        return $val;
    }

    public function rollback() {
        $this->exec('ROLLBACK TRANSACTION');
    }

    public function commit() {
       $this->exec('COMMIT TRANSACTION');
    }

    public function beginTransaction() {
        $this->exec('BEGIN TRANSACTION');
    }

    public function lastInsertId($name = null) {
        $id = null;
        $stmt = $this->query('SELECT SCOPE_IDENTITY()');
        $id = $stmt->fetchColumn();
        $stmt->closeCursor();

        return $id;
    }
}
