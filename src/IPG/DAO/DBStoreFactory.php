<?php

namespace IPG\DAO;

use Medoo\Medoo;

/**
 * This factory create and store Medoo object for database operation. It is a factory store with singleton product,not a pool.
 */
class DBStoreFactory {

    public static $dbs = [];

    public static $_connections = [];


    /**
     * Create and return Medoo connection. It return a existing instance of a product if the connection has already constructed.
     * @param   string  $storeName  Classname of the DBStore implements DBStoreInterface, the class much be exist below current_namespace\Database
     * @return  Medoo
     */
    public static function get($storeName) : Medoo {
        $connectionName = call_user_func(__NAMESPACE__."\\Database\\{$storeName}::getConnectionName");

        if(!isset(self::$dbs[$connectionName])) {
            self::$dbs[$connectionName] = new Medoo(call_user_func(__NAMESPACE__."\\Database\\{$storeName}::getConfig"));
        }

        return self::$dbs[$connectionName];

    }

}