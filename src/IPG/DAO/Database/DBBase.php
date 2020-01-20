<?php

namespace IPG\DAO\Database;

use IPG\Interfaces\DBStoreInterface;

class DBBase implements DBStoreInterface
{

    public static $_connectionName, $_config;

    public static function getConfig() {
        return self::$_config;
    }

    public static function getConnectionName() {
        return self::$_connectionName;
    }

}