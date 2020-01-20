<?php
namespace IPG\Interfaces;

use IPG\Interfaces\BaseProviderInterface;

interface ServiceProviderRegistrationInterface extends BaseProviderInterface{
  function process();
}
