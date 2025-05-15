<?php

namespace Syleo24\Framework\entity;

use Exception;

class User
{
    private ?int $id = null;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private string $phone;
    private string $secret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        if ($id !== null && (!is_int($id) || $id <= 0)) {
            throw new Exception("ID must be a positive integer or null.");
        }
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $cleanUsername = trim($username);

        if (strlen($cleanUsername) < 3) {
            throw new Exception('Username must be at least 3 characters long.');
        }

        $this->username = $cleanUsername;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        if (strlen($password) < 8) {
            throw new Exception('Password must be at least 8 characters long.');
        }
        $this->password = trim($password); // Pas de htmlspecialchars pour le mot de passe
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email n'est pas valide");
        }
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $validRoles = ['user', 'admin', 'client'];
        if (!in_array($role, $validRoles)) {
            throw new Exception("Rôle invalide " . $role);
        }
        $this->role = $role;
        return $this;
    }

    public function hasRole(string|array $roles): bool
    {
        if (is_string($roles)) {
            return $this->role === $roles;
        }

        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }

        return false;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isClient(): bool
    {
        return $this->hasRole('client');
    }

    public function isUser(): bool
    {
        return $this->hasRole('user');
    }

    /**
     * Get the value of phone
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone(?string $phone): static
    {
        $cleanPhone = trim($phone ?? '');

        if (!empty($cleanPhone) && !preg_match('/^[0-9\+\-\.\s]+$/', $cleanPhone)) {
            throw new \Exception("Numéro de téléphone invalide.");
        }

        $this->phone = $cleanPhone;
        return $this;
    }

    /**
     * Get the value of secret
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set the value of secret
     *
     * @return  self
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }
}
