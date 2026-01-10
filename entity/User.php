<?php

class User
{
    private int $id;
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;

    public function __construct(array $data = null)
    {
        if ($data)
            $this->hydrate($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setFirstName($firstName)
    {
        if (is_string($firstName) && $firstName->length > 0) {
            $this->firstName = $firstName;
            return $this;
        }
    }

    public function setLastName($lastName)
    {
        if (is_string($lastName) && $lastName->length > 0) {
            $this->lastName = $lastName;
            return $this;
        }
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
}

