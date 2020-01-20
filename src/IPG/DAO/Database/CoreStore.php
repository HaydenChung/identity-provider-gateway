<?php

namespace IPG\DAO\Database;

use IPG\DAO\Database\DBBase;
use IPG\Interfaces\DBStoreInterface;
use IPG\Config\Config;

class CoreStore extends DBBase implements DBStoreInterface{

    public static $_configPath = 'database.core',
    $_connectionName = 'core';

    public static function getConfig() {
        return Config::get(self::$_configPath);
    }

    public static function getConnectionName() {
        return self::$_connectionName;
    }

}