<?php

/**
 * use IPG/Config/Config::get('layer1.layer2.layer3') to fetch config data, use .(full stop) to separate layer.
 */

return [
  'database' => [
    'identity' => [
      'database_type' => 'mysql',
      'database_name' => 'ipg_identity',
      'server' => 'localhost',
      'username' => 'ipg',
      'password' => 'ipg_passWord'
    ],
    'core' => [
      'database_type' => 'mysql',
      'database_name' => 'ipg_core',
      'server' => 'localhost',
      'username' => 'ipg',
      'password' => 'ipg_passWord'
    ],
  ],
  'cache' => [
    'active' => false,
    'filePath' => '/../route.cache',
  ],
  'env' => 'dev',
  'timeZone' => 'Asia/Hong_Kong',
  'routes_rules' => [
    /**
     * The app will only accept requests with given methods.
     */
    'methods' => ['GET', 'POST'],
    /**
     * Regex check on the routes path, ignore when left blank
     */
    'route_pattern' => ''
  ],
  'core_server' => [
    'domain' => 'http://www.example.com',
    'api_call' => [
      'user_info' => '/idp/get_user_info',
      'user_resource' => '/idp/get_user_resource'
    ],
  ],
  'rootDirectory' => dirname(__DIR__),
  'session' => [
    'token_name' => 'ipg_logged',
    'logged_token' => 'logged_token',
    'expiry' => ''
  ],
  'cookie' => [
    'logged_token' => [
      'name' => 'logged_token',
      'sec_before_expiry' => 7200
    ]
  ],
  'you_could_add_other_config_data'=> null
];
