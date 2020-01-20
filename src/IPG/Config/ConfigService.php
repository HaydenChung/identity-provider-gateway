<?php

namespace Ipg\Config;

use \RuntimeException;
use Exception;

class ConfigService {

    private $_data = null;

    public function __construct(array $data) {
        $this->_data = $data;
    }

    // public static function setData($data) {
    //     self::$_data = $data;
    // }

    public function initCheck() {
        if($this->_data == null) throw new Exception('Configuration data is empty. Run Config::init($configData) before using Config');
    }

    /**
     * Get config data.
     * @param   string  $path   Path to reach the data, layer delimite by full stop. eg. layer1.layer2.layer3
     * @return
     */
    public function get(string $path) {

        $config = $this->_data;
        $pathArr = explode('.', $path);

        foreach($pathArr as $bit){
            if(isset($config[$bit])){
                $config = $config[$bit];
            }else{
                throw new RuntimeException('Invalid config path given:'.$path);
            }
        }
        return $config;

    }


    /**
     * Change config value on run time
     */
    public function update(string $path, $value) {
    
        $config = &$this->_data;
        $pathArr = explode('.', $path);

        foreach($pathArr as $bit){
            if(isset($config[$bit])){
                $config = $config[$bit];
            }else{
                $config[$bit] = [];
                $config = &$config[$bit];
            }
        }
        return $config = $value;

    }
    
}