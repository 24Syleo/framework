<?php

namespace Syleo24\Framework\model;

use PDO;
use Exception;
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
    public function getById(int $id): ?User
    {
        try {
            $query = "SELECT * FROM users WHERE id=?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($id));
            $array = $stmt->fetch(PDO::FETCH_ASSOC);
            // Si aucun résultat n'est trouvé, on retourne null
            if (!$array) {
                return null;
            }
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
    public function getByEmail(string $email): ?User
    {
        try {
            $query = "SELECT * FROM users WHERE email=?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($email));
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si aucun résultat n'est trouvé, on retourne null
            if (!$array) {
                return null;
            }
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
            $query = "INSERT INTO users (username, email, password, role, phone) VALUES (?,?,?,?, ?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($user->getUsername(), $user->getEmail(), $user->getPassword(), $user->getRole(), $user->getPhone()));
            return $this->getById($this->pdo->lastInsertId());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(): array
    {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array_map(function ($array) {
                return UserSerializer::fromArray($array);
            }, $array);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getByRole(string $role): array
    {
        try {
            $query = "SELECT * FROM users WHERE role = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$role]);
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($array) {
                return UserSerializer::fromArray($array);
            }, $array);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(User $user): User
    {
        try {
            $query = "UPDATE users SET username=?, email=?, role=?, phone=? WHERE id=?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getRole(), $user->getPhone(), $user->getId()]);
            return $this->getById($user->getId());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update_secret($secret, $id): User
    {
        try {
            $query = "UPDATE users SET secret=:secret WHERE id=:id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(["secret" => $secret, "id" => $id]);
            return $this->getById($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
