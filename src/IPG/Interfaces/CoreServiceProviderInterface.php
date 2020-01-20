<?php

namespace IPG\Interfaces;

use IPG\Interfaces\BaseProviderInterface;
use Psr\Http\Message\ServerRequestInterface;

interface CoreServiceProviderInterface extends BaseProviderInterface{
  /**
   * Get standard user info, like name and email.
   */
  function get_identity_info(string $token, ServerRequestInterface $request);

  /**
   * Get other resource from core system.
   */
  function get_resource_info(string $token, ServerRequestInterface $request);
}
