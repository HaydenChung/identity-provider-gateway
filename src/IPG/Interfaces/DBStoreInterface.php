<?php

namespace IPG\Interfaces;

interface DBStoreInterface {

    /**
     * @return  string  Unique name of the connection.
     */
    public static function getConnectionName();

    /**
     * @return  string  Init data to construct the Medoo object.
     */
    public static function getConfig();

}