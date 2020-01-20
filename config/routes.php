<?php

return [
    'root'=> [
        'method'=> 'GET',
        'routePattern'=> '/',
        'handler'=> 'IPG\Providers\LoginProvider::login_page',
        'params'=>[]
    ],
    'login'=> [
        'method'=>'GET',
        'routePattern'=>'/login',
        'handler'=> 'IPG\Providers\LoginProvider::login_page',
        'params'=>[]
    ],
    'login_process'=> [
        'method'=>'POST',
        'routePattern'=>'/login_process',
        'handler'=> 'IPG\Providers\LoginProvider::login_handler',
        'params'=>[]
    ],
    'service_registration'=> [
        'method'=>'GET',
        'routePattern'=>'/service_registration',
        'handler'=> 'IPG\Providers\ServiceProviderRegistration::process',
        'params'=>[]
    ],
    'sp_get_user'=> [
        'method'=>'GET',
        'routePattern'=>'/sp_get_user/{token}',
        'handler'=> 'IPG\Providers\CoreServiceProvider::get_identity_info',
        'params'=>[]
    ],
    'sp_get_res'=> [
        'method'=>'GET',
        'routePattern'=>'/sp_get_res/{token}',
        'handler'=> 'IPG\Providers\CoreServiceProvider::get_resource_info',
        'params'=>[]
    ],
    'forget_pass'=> [
        'method'=>['POST','PUT'],
        'routePattern'=>'/forget_pass',
        'handler'=> 'IPG\Providers\CoreServiceProvider::forget_password',
        'params'=>[]
    ],
];