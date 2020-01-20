<?php

namespace IPG;

use IPG\HttpMessageHandler;
use IPG\Config\Config;

class IPGFactory{
  public static function create(
      HttpMessageHandler $route,
      Config $config
  ) {
    $config->initCheck();
    return new IdentityProviderGateway(
      $route
    );
  }
}
