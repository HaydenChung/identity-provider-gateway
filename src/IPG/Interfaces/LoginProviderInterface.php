<?php
namespace IPG\Interfaces;

use Psr\Http\Message\ServerRequestInterface;
use IPG\Interfaces\BaseProviderInterface;

interface LoginProviderInterface extends BaseProviderInterface{
  
  function login_handler(ServerRequestInterface $request);
  function login_verify(ServerRequestInterface $request);
  function login_success_handler(string $uri);
  function login_fail_handler(string $uri);
}
