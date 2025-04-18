<?php

use Syleo24\Framework\core\Model;
use Syleo24\Framework\entity\User;
use Syleo24\Framework\serializer\UserSerializer;

class UserModel extends Model
{
    /**
     * Summary of getById
     * @param int $id
     * @return User
     */
    public function getById(int $id): User
    {
        try {
            $query = "SELECT * FROM users WHERE id=?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($id));
            $array = $stmt->fetch(PDO::FETCH_ASSOC);
            return UserSerializer::fromArray($array);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Summary of getByEmail
     * @param string $email
     * @return User
     */
    public function getByEmail(string $email): User
    {
        try {
            $query = "SELECT * FROM users WHERE email=?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($email));
            $array = $stmt->fetch(PDO::FETCH_ASSOC);
            return UserSerializer::fromArray($array);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Summary of insert
     * @param Syleo24\Framework\entity\User $user
     * @return User
     */
    public function insert(User $user): User
    {
        try {
            $query = "INSERT INTO users (username, email, password, role) VALUES (?,?,?,?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($user->getUsername(), $user->getEmail(), $user->getPassword(), $user->getRole()));
            return $this->getById($this->pdo->lastInsertId());
        } catch (Exception $e) {
            throw $e;
        }
    }
}
