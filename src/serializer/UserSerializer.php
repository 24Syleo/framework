<?php

namespace Syleo24\Framework\serializer;

use Syleo24\Framework\entity\User;

class UserSerializer
{
    public static function fromArray(array $data): User
    {
        $user = new User();
        if (isset($data['id'])) {
            $user->setId($data['id']);
        }
        if (isset($data['phone'])) {
            $user->setPhone($data['phone']);
        }
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setRole($data['role']);
        return $user;
    }

    public static function toArray(User $user): array
    {
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole(),
            'phone' => $user->getPhone(),
        ];
    }
}
