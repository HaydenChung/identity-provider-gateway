<?php
namespace IPG\Providers;
use Psr\Log\LoggerInterface;
use IPG\Interfaces\ServiceProviderRegistrationInterface;

use Zend\Diactoros\Response\HtmlResponse;

class ServiceProviderRegistration implements ServiceProviderRegistrationInterface{

  function __construct(){
  }
  function process(){

    return new HtmlResponse('On Dev');

    // echo "Process Service Provider ask for IPG Reconize.";
  }

}
