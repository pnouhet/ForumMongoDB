<?php

class User
{
    private int $id;
    private string $email;
    private string $password;
    private string $username;
    private string $role;
    private string $createdAt;

    public function __construct(array $data = null)
    {
        if ($data)
            $this->hydrate($data);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setUsername($username)
    {
        if (is_string($username) && $username->length > 0) {
            $this->username = $username;
        }
    }

    public function setCreatedAt($date)
    {
            $this->createdAt = $date;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method(trim($value));
            }
        }
    }

    public function toArray()
    {
        return [
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
            "role" => $this->role,
            "createdAt" => $this->createdAt,
        ];
    }

    
}

