<?php

namespace Ipg\Config;

use IPG\Interfaces\ConfigDataInterface;

class DevConfig implements ConfigDataInterface {

    private $_instance;

    public static function getInstance() {

        if(self::$_instance == null) {
            self::$_instance = new DevConfig();
        }

        return self::$_instance;

    }

    public static function getIdentityDB(): array
    {
        
        return [
            'database_type' => 'mysql',
            'database_name' => 'ipg_identity',
            'server' => 'localhost',
            'username' => 'ipg',
            'password' => 'ipg_passWord'
        ];

    }

    public static function getCoreDB(): array
    {
        return [
            'database_type' => 'mysql',
            'database_name' => 'ipg_core',
            'server' => 'localhost',
            'username' => 'ipg',
            'password' => 'ipg_passWord'
        ];

    }

    public static function isCaching(): bool
    {
        return false;
    }

    public static function getEnv(): string
    {
        return 'dev';
    }

    public static function cacheFilePath(): string
    {
        return '/../route.cache';
    }

    public static function getTimeZone(): string
    {
        return 'Asia/Hong_Kong';
    }
}