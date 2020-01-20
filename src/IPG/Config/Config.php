<?php

namespace IPG\Config;

use Exception;
use Ipg\Config\ConfigService;
use IPG\Interfaces\ConfigDataInterface;


/**
 * Config class to provide configuration data, much run Config::init($configData) to provide config data before run
 */
class Config implements ConfigDataInterface {

    private static $_instance, $_service;

    public function __construct() {

    }

    public static function getInstance(): ConfigDataInterface {

        if(self::$_instance == null) {
            self::$_service->initCheck();
            self::$_instance = new Config();
        }

        return self::$_instance;

    }

    public static function init(array $configData): ConfigDataInterface {

        if(self::$_instance != null) throw new Exception('Config has already init');

        self::$_service = new ConfigService($configData);
        self::$_instance = new Config();
        date_default_timezone_set(self::$_service->get('timeZone'));
        return self::$_instance;
    }

    public static function initCheck() {
        return self::$_service->initCheck();
    }

    public static function getCoreDB(): array
    {
        return self::$_service->get('database.core');
    }

    public static function getIdentityDB(): array
    {
        return self::$_service->get('database.identity');
    }

    public static function getEnv(): string
    {
        return self::$_service->get('env');
    }

    public static function getTimeZone(): string
    {
        return self::$_service->get('timeZone');
    }

    public static function isCaching(): bool
    {
        return self::$_service->get('cache.active');
    }

    public static function cacheFilePath(): string
    {
        return self::$_service->get('cache.filePath');
    }

    public static function getRoutes(): array
    {
        return self::$_service->get('routes');
    }

    public static function getSessionName() 
    {
        return self::$_service->get('session.token_name');
    }

    public static function getLoggedTokenName()
    {
        return self::$_service->get('cookie.logged_token.name');
    }

    public static function getLoggedTokenExpiry()
    {
        return self::$_service->get('cookie.logged_token.sec_before_expiry');
    }

    public static function getRouteMethods()
    {
        return self::$_service->get('routes_rules.methods');
    }

    public static function getRoutePattern()
    {
        return self::$_service->get('routes_rules.route_pattern');
    }

    public static function getRootDirectory()
    {
        return self::$_service->get('rootDirectory');
    }

    /**
     * Get config data.
     * @param   string  $path   Path to reach the data, layer delimite by full stop. eg. layer1.layer2.layer3
     * 
     */
    public static function get(string $path)
    {
        return self::$_service->get($path);
    }

    /**
     * Change config value, please note config data usually related to environment, make sure you need to change config data in runtime.
     * @param   string  $path   Path to reach the data, layer delimite by full stop. eg. layer1.layer2.layer3
     * @param   string  $value  Value to store into config data
     */
    public static function update(string $path, $value) 
    {
        return self::$_service->update($path, $value);
    }

}