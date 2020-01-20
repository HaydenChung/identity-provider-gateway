<?php

namespace IPG\Interfaces;

interface ConfigDataInterface {
    /**
     * To init the configuration class.
     * @param   array   $configData Configuration data to be use in the app, please look up config/config.default.php for basic data.
     * @return self
     */
    public static function init(array $configData) : self;

    /**
     * To get the configuration data of identity database
     * @return array
     */
    public static function getIdentityDB() : array;
    /**
     * To get the configuration data of core database
     * @return array
     */
    public static function getCoreDB() : array;
    /**
     * If this config use caching
     * @return bool
     */
    public static function isCaching() : bool;
    /**
     * Get the path to caching file
     */
    public static function cacheFilePath() : string;
    /**
     * To get the env of the config
     * @return array
     */
    public static function getEnv() : string;
    /**
     * To get the config default timezone
     * @return  string
     */
    public static function getTimeZone() : string;
}