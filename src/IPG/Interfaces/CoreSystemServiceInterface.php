<?php

namespace IPG\Interfaces;

use IPG\Interfaces\BaseProviderInterface;

interface CoreSystemServiceInterface  extends BaseProviderInterface{

    /**
     * Check if user is logged at the identity gateway.
     */
    public function checkLogin(?string $username, ?string $email, string $password);

    /**
     * Check if user could login at the core system.
     */
    public function login(?string $username, ?string $email, ?string $password);

    /**
     * Get user info from the identity gateway.
     */
    public function getUserInfo(string $token);

    /**
     * Get other resource from core system.
     */
    public function getUserResource(string $token);

}