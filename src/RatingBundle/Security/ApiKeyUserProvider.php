<?php

namespace RatingBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class ApiKeyUserProvider implements UserProviderInterface
{
    private $tokenStore = [
        'wGHkZpq43veHysyxKnrJkDxV'=> 'user_api_rest'
    ];


    public function getUsernameForApiKey($apiKey)
    {
        return $this->tokenStore[$apiKey];
    }

    public function loadUserByUsername($username)
    {
        return new User(
            $username,
            null,
            array('ROLE_USER')
        );
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }
}